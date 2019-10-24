<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\RaidRepository;
use App\Repository\SignupRepository;
use DateInterval;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RaidController extends AbstractController
{
    /**
     * @var RaidRepository
     */
    private $raidRepository;
    /**
     * @var RaidEventRepository
     */
    private $eventRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SignupRepository
     */
    private $signUpRepository;

    public function __construct(
        RaidRepository $raidRepository,
        RaidEventRepository $raidEventRepository,
        CharacterRepository $characterRepository,
        SignupRepository $signUpRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->raidRepository = $raidRepository;
        $this->eventRepository = $raidEventRepository;
        $this->characterRepository = $characterRepository;
        $this->signUpRepository = $signUpRepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/raid", name="raid")
     */
    public function indexAction(): Response
    {
        $raids = $this->raidRepository->findBy([], ['date' => 'DESC']);
        return $this->render('raid/index.html.twig', [
            'raids' => $raids,
        ]);
    }

    /**
     * @Route("/raid/show/{raidId}", name="raid_show")
     * @param $raidId
     * @return Response
     */
    public function showAction($raidId): Response
    {
        $raid = $this->raidRepository->find((int) $raidId);
        return $this->render('raid/show.html.twig', [
            'raid' => $raid,
        ]);
    }

    /**
     * @Route("/raid/edit/{raidId}", name="raid_edit")
     * @param $raidId
     * @return Response
     */
    public function editAction($raidId): Response
    {
        $raid = $this->raidRepository->find((int) $raidId);
        return $this->render('page/lootresult.html.twig', [
            'raid' => $raid,
        ]);
    }

    /**
     * @Route("/raid/signup/{event?}", name="raid_signup")
     * @param $event
     * @return Response
     * @throws Exception
     */
    public function signUpAction($event): Response
    {
        $raids = $this->eventRepository->findEventsAndSignUps();
        $activeRaid = null;
        $signUps = null;
        $cancellations = null;
        $showSignUpForm = false;
        $eventTime = null;
        $serverTime = null;
        if ($event) {
            $activeRaid = $this->eventRepository->find($event);
            $eventTime = $activeRaid->getStart();
            if ($eventTime) {
                $eventTime->sub(new DateInterval('PT6H'));
            }
            $serverTime = new DateTime('now', new DateTimeZone('UTC'));
            if ($eventTime  > $serverTime) {
                $showSignUpForm = true;
            }
            $signUps = $this->signUpRepository->findBy(
                [
                'raidEvent' => $activeRaid,
                'signedUp' => 1
                ], [
                    'team' => 'ASC'
                ]
            );
            $cancellations = $this->signUpRepository->findBy([
                'raidEvent' => $activeRaid,
                'signedUp' => 2
            ]);
        }
        $response = new Response();
        $response->setSharedMaxAge(5);
        return $this->render('raid/signup.html.twig', [
            'raids' => $raids,
            'activeRaid' => $activeRaid,
            'signUps' => $signUps,
            'cancellations' => $cancellations,
            'showSignUpForm' => $showSignUpForm,
            'endOfSignUp' => $eventTime,
            'serverTime' => $serverTime,
            'account' => $this->getUser()
        ], $response);
    }

    /**
     * @Route("/raid/signupforraid/{eventId}/{characterId}", name="raid_signupforraid")
     * @param int $characterId
     * @param int $eventId
     * @return Response
     */
    public function signUpForRaidAction(int $characterId, int $eventId): Response
    {
        $character = $this->characterRepository->find($characterId);
        $event = $this->eventRepository->find($eventId);
        if ($character && $event) {
            $this->handleSignUp($character, $event, 1);
        }
        return $this->redirectToRoute('raid_signup', ['event' => $eventId]);
    }

    /**
     * @Route("/raid/signoutforraid/{eventId}/{characterId}", name="raid_signoutforraid")
     * @param int $characterId
     * @param int $eventId
     * @return Response
     */
    public function signOutForRaidAction(int $characterId, int $eventId): Response
    {
        $character = $this->characterRepository->find($characterId);
        $event = $this->eventRepository->find($eventId);
        if ($character && $event) {
            $this->handleSignUp($character, $event, 2);
        }

        return $this->redirectToRoute('raid_signup', ['event' => $eventId]);
    }

    /**
     * @Route("/raid/manageteams", name="raid_manageteams")
     * @param Request $request
     * @return Response
     */
    public function manageRaidTeamsAction(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_RAIDMANAGER');
        $eventId = $request->request->get('eventId');
        $assignments = $request->request->get('assignment');
        $confirmations = $request->request->get('confirmed');
        foreach ($confirmations as $confirmId => $confirmStatus) {
            $signUp = $this->signUpRepository->find($confirmId);
            if($signUp) {
                if ($confirmStatus === 'on') {
                    $signUp->setConfirmed(true);
                } else {
                    $signUp->setConfirmed(false);
                }
                $this->entityManager->persist($signUp);
            }
        }
        foreach ($assignments as $signUpId => $team) {
            $signUp = $this->signUpRepository->find($signUpId);
            if($signUp) {
                $signUp->setTeam($team);
                $this->entityManager->persist($signUp);
            }
        }
        $this->entityManager->flush();
        return $this->redirectToRoute('raid_signup', ['event' => $eventId]);
    }

    private function handleSignUp(Character $character, RaidEvent $event, int $status): void
    {
        $signUp = $this->signUpRepository->findOneBy([
            'playerName' => $character,
            'raidEvent' => $event
        ]);
        if (!$signUp) {
            $signUp = new Signup();
            $signUp->setPlayerName($character);
            $signUp->setRaidEvent($event);
            $signUp->setConfirmed(false);
        }
        $signUp->setSignedUp($status);
        $this->entityManager->persist($signUp);
        $this->entityManager->flush();
    }
}
