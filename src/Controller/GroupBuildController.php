<?php

namespace App\Controller;

use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
use App\Repository\SignupRepository;
use App\Service\SignUpService;
use App\Utility\WoWZoneUtility;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupBuildController extends AbstractController
{
    /**
     * @var SignupRepository
     */
    private $signUpRepository;
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;
    /**
     * @var RaidGroupRepository
     */
    private $raidGroupRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var SignUpService
     */
    private $signUpService;
    /**
     * @var WoWZoneUtility
     */
    private $zoneUtility;

    public function __construct(
        SignupRepository $signupRepository,
        RaidEventRepository $raidEventRepository,
        RaidGroupRepository $raidGroupRepository,
        CharacterRepository $characterRepository,
        SignUpService $signUpService,
        WoWZoneUtility $zoneUtility
    )
    {
        $this->signUpRepository = $signupRepository;
        $this->raidEventRepository = $raidEventRepository;
        $this->raidGroupRepository = $raidGroupRepository;
        $this->characterRepository = $characterRepository;
        $this->signUpService = $signUpService;
        $this->zoneUtility = $zoneUtility;
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
     * @param int $raidEvent
     * @param $raidGroupId
     * @return Response
     */
    public function buildGroupAction(int $raidEvent, $raidGroupId): Response
    {
        $raid = $this->raidEventRepository->find($raidEvent);
        if(!$raid) {
            return new Response('raid not found', 404);
        }
        $raidSignUps = $this->signUpService->classifySignUpsByRaid($raid);
        $raidGroup = null;
        if ($raidGroupId) {
            $raidGroup = $this->raidGroupRepository->find($raidGroupId);
        }
        $signUps = $raidSignUps['signUps'];
        $assignedPlayers = [];
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
                }
            }
            $raidGroup->setSetup($raidSetup);
        }
        /**
         * Manage Twinks
         */
        return $this->render('group_build/buildGroup.html.twig', [
            'raid' => $raid,
            'signUps' => $signUps,
            'raidGroup' => $raidGroup,
            'assignedPlayers' => $assignedPlayers,
            'cancellations' => $raidSignUps['cancellations'],
            'noFeedback' => $raidSignUps['noFeedback']
        ]);
    }
}
