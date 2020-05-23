<?php

namespace App\Command;

use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStubsCommand extends Command
{
    protected static $defaultName = 'app:create-stubs';

    protected $maxEvents = 10;

    protected $maxSignUps = 50;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var SignupRepository
     */
    private $signUpRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    public function __construct(EntityManagerInterface $entityManager, SignupRepository $signupRepository, CharacterRepository $characterRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->signUpRepository = $signupRepository;
        $this->characterRepository = $characterRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Adds stub data to test the raid tool')
            ->addOption('events', null, InputOption::VALUE_NONE, 'The number of events to create. Defaults to 10 events in the future')
            ->addOption('signups', null, InputOption::VALUE_NONE, 'The number of signups to create. Defaults to 50')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('events') && is_numeric($input->getOption('events'))) {
            $this->maxEvents = (int)$input->getOption('events');
        }
        if ($input->getOption('signups') && is_numeric($input->getOption('signups'))) {
            $this->maxSignUps = (int)$input->getOption('signups');
        }
        $this->createEvents($this->maxEvents);

        $io->success('Done');

        return 0;
    }

    private function createEvents(int $maxEvents): void
    {
        $i = 0;
        while($i < $maxEvents) {
            $event = $this->createSingleEvent();
            $this->createSignUps($event, $this->maxSignUps);
            $i++;
        }
    }

    private function createSingleEvent(): RaidEvent
    {
        $event = new RaidEvent();
        $event->setTitle($this->randomString());
        $startTime = new DateTime();
        try {
            $differenceInDays = random_int(1, 10);
        } catch (Exception $e) {
            $differenceInDays = 4;
        }
        try {
            $interval = new \DateInterval('P' . $differenceInDays . 'D');
        } catch (Exception $e) {
            $interval = new \DateInterval('P5D');
        }
        $startTime->add($interval);
        $event->setStart($startTime);
        $this->entityManager->persist($event);
        $this->entityManager->flush();
        return $event;
    }

    private function createSignUps(RaidEvent $event, int $numSignUps): void
    {
        $allCharacters = $this->characterRepository->findBy(['hidden' => false]);
        $characterToSignUp = array_rand($allCharacters, $numSignUps);
        foreach ($characterToSignUp as $index => $item) {
            $signUp = new Signup();
            $signUp->setPlayerName($allCharacters[$item]);
            $signUp->setRaidEvent($event);
            $signUp->setSignedUp(1);
            $this->entityManager->persist($signUp);

            $foo = '';
        }
        $this->entityManager->flush();
    }

    private function randomString(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            try {
                $randomString .= $characters[random_int(0, strlen($characters))];
            } catch (Exception $e) {
                $randomString = 'Error in creating random string';
            }
        }
        return $randomString;
    }
}
