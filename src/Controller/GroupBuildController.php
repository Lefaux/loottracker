<?php

namespace App\Controller;

use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
use App\Service\RaidGroupService;
use App\Service\SignUpService;
use App\Utility\WoWZoneUtility;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupBuildController extends AbstractController
{
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;
    /**
     * @var RaidGroupRepository
     */
    private $raidGroupRepository;
    /**
     * @var SignUpService
     */
    private $signUpService;
    /**
     * @var WoWZoneUtility
     */
    private $zoneUtility;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        RaidEventRepository $raidEventRepository,
        RaidGroupRepository $raidGroupRepository,
        SignUpService $signUpService,
        WoWZoneUtility $zoneUtility,
        EntityManagerInterface $em
    )
    {
        $this->raidEventRepository = $raidEventRepository;
        $this->raidGroupRepository = $raidGroupRepository;
        $this->signUpService = $signUpService;
        $this->zoneUtility = $zoneUtility;
        $this->entityManager = $em;
    }

    /**
     * @Route("/group/build/", name="group_index")
     * @return Response
     * @throws Exception
     */
    public function indexAction(): Response
    {
        $raids = $this->raidEventRepository->findEventsAndSignUps();
        foreach ($raids as $index => $raid) {
            $event = $this->raidEventRepository->find($raid['id']);
            if ($event) {
                $signUpData = $this->signUpService->classifySignUpsByRaid($event);
                $raids[$index]['signUps'] = count($signUpData['signUps']);
                $raids[$index]['cancellations'] = count($signUpData['cancellations']);
                $raids[$index]['noFeedback'] = count($signUpData['noFeedback']);
                $raids[$index]['event'] = $event;
            }
        }
        return $this->render('group_build/index.html.twig', [
            'raids' => $raids,
            'zones' => $this->zoneUtility
        ]);
    }

    /**
     * @Route("/group/build/setup/{raidEvent}/{raidGroupId?}", name="group_build")
     * @param RaidGroupService $raidGroupService
     * @param CharacterRepository $characterRepository
     * @param int $raidEvent
     * @param $raidGroupId
     * @return Response
     */
    public function buildGroupAction(RaidGroupService $raidGroupService, CharacterRepository $characterRepository, int $raidEvent, $raidGroupId): Response
    {
        $raid = $this->raidEventRepository->find($raidEvent);
        if(!$raid) {
            return new Response('raid not found', 404);
        }
        $raidSignUps = $this->signUpService->classifySignUpsByRaid($raid);
        $raidGroup = null;
        if ($raidGroupId) {
            $raidGroup = $this->raidGroupRepository->find($raidGroupId);
            $otherRaidGroupsInThisId = $raidGroupService->findPlayersInOtherRaidGroupsInThisIdAndZone($raidGroup);
        } else {
            $otherRaidGroupsInThisId = [];
        }
        $signUps = $raidSignUps['signUps'];
        $assignedPlayers = [];
        $playersInOtherSetups = [];
        if ($raidGroupId && $raidGroup) {
            $raidSetup = $raidGroup->getSetup();
            /**
             * Find all players currently
             */
            foreach ($raidSetup['groups'] as $groupId => $group) {
                foreach ($group as $playerIndex => $playerId) {
                    /** @var Signup $signUp */
                    foreach ($signUps as $signUpIndex => $signUp) {
                        if ($signUp->getPlayerName() && (int)$playerId === $signUp->getPlayerName()->getId()) {
                            $raidSetup['groups'][$groupId][$playerIndex] = $signUp->getPlayerName();
                            if ($signUp->getPlayerName()->getAccount()) {
                                $assignedPlayers[] = $signUp->getPlayerName()->getAccount()->getId();
                            }
                            unset($signUps[$signUpIndex]);
                        }
                    }
                    // Check if somebody cancelled after being put into the raid setup
                    if (array_key_exists((int)$playerId, $raidSignUps['cancellations'])) {
                        unset($raidSetup['groups'][$groupId][$playerIndex]);
                    }
                }
            }
            if (isset($raidSetup['bench'])) {
                foreach ($raidSetup['bench'] as $benchId => $bench) {
                    $character = $characterRepository->find($bench);
                    if ($character) {
                        $raidSetup['bench'][$benchId] = $character;
                    }
                }
            } else {
                $raidSetup['bench'] = [];
            }
            $raidGroup->setSetup($raidSetup);
        }
        foreach ($signUps as $signUpIndex => $signUp) {
            if (in_array((int)$signUp->getPlayerName()->getId(), $otherRaidGroupsInThisId, true)) {
                $playersInOtherSetups[] = $signUp->getPlayerName();
                unset($signUps[$signUpIndex]);
            }
        }
        /**
         * Manage Twinks
         */
        return $this->render('group_build/buildGroup.html.twig', [
            'raid' => $raid,
            'signUps' => $signUps,
            'raidGroup' => $raidGroup,
            'assignedPlayers' => $assignedPlayers,
            'playersInOtherSetups' => $playersInOtherSetups,
            'playersOnBench' => $raidSetup['bench'] ?? [],
            'cancellations' => $raidSignUps['cancellations'],
            'noFeedback' => $raidSignUps['noFeedback']
        ]);
    }

    /**
     * @Route("/group/build/delete/{raidGroupId}", name="group_delete")
     * @param int $raidGroupId
     * @return Response
     */
    public function deleteAction(int $raidGroupId): Response
    {
        $raidGroup = $this->raidGroupRepository->find($raidGroupId);
        if ($raidGroup) {
            $event = $raidGroup->getEvent();
            if ($event) {
                $event->removeRaidGroup($raidGroup);
                $this->entityManager->remove($raidGroup);
                $this->entityManager->persist($event);
                $this->entityManager->flush();
                $this->addFlash('success', 'Deleted raidgroup "'. $raidGroup->getName()  .'"');
            }
        }
        return $this->redirectToRoute('group_index');
    }
}
