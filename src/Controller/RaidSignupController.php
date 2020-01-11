<?php

namespace App\Controller;

use App\Entity\Character;
use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Entity\User;
use App\Repository\CharacterRepository;
use App\Repository\RaidEventRepository;
use App\Repository\SignupRepository;
use App\Service\DiscordBotService;
use App\Service\SignUpService;
use App\Utility\WoWZoneUtility;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Woeler\DiscordPhp\Message\DiscordEmbedsMessage;

class RaidSignupController extends AbstractController
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var RaidEventRepository
     */
    private $raidEventRepository;
    /**
     * @var SignupRepository
     */
    private $signUpRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var WoWZoneUtility
     */
    private $zoneUtility;
    /**
     * @var SignUpService
     */
    private $signUpService;

    public function __construct(
        RaidEventRepository $raidEventRepository,
        CharacterRepository $characterRepository,
        SignupRepository $signUpRepository,
        EntityManagerInterface $entityManager,
        WoWZoneUtility $zoneUtility,
        SignUpService $signUpService
    )
    {
        $this->characterRepository = $characterRepository;
        $this->raidEventRepository = $raidEventRepository;
        $this->signUpRepository = $signUpRepository;
        $this->entityManager = $entityManager;
        $this->zoneUtility = $zoneUtility;
        $this->signUpService = $signUpService;
    }

    /**
     * @Route("/raid/signup", name="raid_signup")
     */
    public function indexAction(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $charsOnAccount = [];
        $charArray = [];
        /** @var Character $character */
        foreach ($user->getCharacters() as $character) {
            $charsOnAccount[$character->getId()] = $character;
            $charArray[] = $character->getId();
        }
        $signUps = $this->signUpRepository->findSignUpsPerAccount($charArray);
        $events = $this->raidEventRepository->findEventsAndSignUps();
        foreach ($events as $index => $event) {
            $eventObject = $this->raidEventRepository->find($event['id']);
            if (!$eventObject) {
                return new Response('Error finding a raid event', 500);
            }
            $events[$index]['deadline'] = SignUpService::findRaidSignUpEnd($event['start']);
            $events[$index]['raidGroups'] = $eventObject->getRaidGroups();
            $events[$index]['charsInSetup'] = SignUpService::findCharsInSetup($eventObject->getRaidGroups(), $charsOnAccount);
        }
        return $this->render('raid_signup/index.html.twig', [
            'events' => $events,
            'account' => $user,
            'signUps' => $signUps,
            'zones' => $this->zoneUtility
        ]);
    }

    /**
     * @Route("/raid/signup/edit", name="raid_signup_edit")
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request): Response
    {
        $signUps = $request->request->get('signup');
        foreach ($signUps as $characterId => $events) {
            $character = $this->characterRepository->find($characterId);
            if (!$character) {
                $this->addFlash('error', 'Character not found, hack somewhere else');
            }
            foreach ($events as $eventId => $status) {
                $event = $this->raidEventRepository->find($eventId);
                if (!$event) {
                    $this->addFlash('error', 'Event not found, hack somewhere else');
                }
                if ($status === 'yes') {
                    $status = 1;
                }
                if ($status === 'no') {
                    $status = 2;
                }
                $this->handleSignUp($character, $event, $status);
            }
        }
        $this->addFlash('success', 'Raid SignUps saved');
        return $this->redirectToRoute('raid_signup');
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
        }
        $signUp->setSignedUp($status);
        $this->entityManager->persist($signUp);
        $this->entityManager->flush();
    }

    /**
     * @Route("/raid/signup/cancelbyclass/{class?}", name="raid_signup_cancelbyclass")
     * @param DiscordBotService $discordBotService
     * @param int $class
     * @return Response
     */
    public function listNoFeedbackByClassAction(DiscordBotService $discordBotService, $class = 0): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user || !$user->hasRole('ROLE_RAIDMANAGER')) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $raids = [];
        $usersToMention = [];
        $class = (int)$class;
        $raidSignUps = $this->raidEventRepository->findEventsAndSignUps();
        foreach ($raidSignUps as $index => $raid) {
            $event = $this->raidEventRepository->find($raid['id']);
            if ($event) {
                $signUpData = $this->signUpService->classifySignUpsByRaid($event);
                /** @var Character $player */
                foreach ($signUpData['noFeedback'] as $player) {
                    if ($player->getClass() === $class) {
                        $raids[$index]['noFeedback'][] = $player;
                        if ($player->getAccount()) {
                            $usersToMention[$player->getAccount()->getDiscordMention()][] = $player;
                        }
                        $raids[$index]['event'] = $event;
                    }
                }

            }
        }
        // send nag
        $description = '';
        foreach ($usersToMention as $mention => $playerToMention) {
            $description .= 'Hier fehlen noch Anmeldungen von ' . $mention . PHP_EOL;
        }


        $message = new DiscordEmbedsMessage();
        $message->setTitle('You did not sign up!');
        $message->setAuthorName('Askeria Nag Bot');
        $message->setDescription('
        Test! '. PHP_EOL . $description);
        //@todo configure channel IDs
//        $discordBotService->sendMessage('624921527724408842', $message);
        return $this->render('raid_signup/cancelbyclass.html.twig', [
            'class' => $class,
            'raids' => $raids
        ]);
    }

}
