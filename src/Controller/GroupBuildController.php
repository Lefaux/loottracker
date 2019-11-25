<?php

namespace App\Controller;

use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidGroupRepository;
use App\Repository\SignupRepository;
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

    public function __construct(
        SignupRepository $signupRepository,
        RaidEventRepository $raidEventRepository,
        RaidGroupRepository $raidGroupRepository,
        CharacterRepository $characterRepository
    )
    {
        $this->signUpRepository = $signupRepository;
        $this->raidEventRepository = $raidEventRepository;
        $this->raidGroupRepository = $raidGroupRepository;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @Route("/group/build/", name="group_index")
     * @return Response
     * @throws Exception
     */
    public function indexAction(): Response
    {
        $raids = $this->raidEventRepository->findEventsAndSignUps();
        return $this->render('group_build/index.html.twig', [
            'raids' => $raids
        ]);
    }

    /**
     * @Route("/group/build/setup/{raidEvent}", name="group_build")
     * @param RaidEvent $raidEvent
     * @return Response
     */
    public function buildGroupAction($raidEvent): Response
    {
        $raid = $this->raidEventRepository->find($raidEvent);
        if(!$raid) {
            return new Response('raid not found', 404);
        }
        $cancellations = [];
        $noFeedback = [];
        $allCharacters = $this->characterRepository->findBy(['hidden' => false]);
        foreach ($allCharacters as $character) {
            $noFeedback[$character->getId()] = $character;
        }

        $signUps = $this->signUpRepository->findByRaid($raid);
        /**
         * @var integer $index
         * @var  Signup $signUp
         */
        foreach ($signUps as $index => $signUp) {
            if ($signUp->getSignedUp() === 2) {
                $cancellations[] = $signUp->getPlayerName();
                unset($signUps[$index], $noFeedback[$signUp->getPlayerName()->getId()]);
            }
            if ($signUp->getSignedUp() === 1) {
                unset($noFeedback[$signUp->getPlayerName()->getId()]);
            }
        }
        $raidGroup = $this->raidGroupRepository->findOneBy([
            'event' => $raid
        ]);
        $assignedPlayers = [];
        $raidSetup = ['groups' => []];
        if ($raidGroup) {
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
        }
        /**
         * Manage Twinks
         */
        return $this->render('group_build/buildGroup.html.twig', [
            'raid' => $raid,
            'signUps' => $signUps,
            'setup' => $raidSetup['groups'],
            'assignedPlayers' => $assignedPlayers,
            'cancellations' => $cancellations,
            'noFeedback' => $noFeedback
        ]);
    }

//    /**
//     * @Route("/group/build/create/{raidEvent}", name="group_create")
//     * @return Response
//     */
//    public function createRaidAction($raidEvent): Response
//    {
//        $raid = $this->raidEventRepository->find($raidEvent);
//    }
}
