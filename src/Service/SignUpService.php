<?php


namespace App\Service;

use App\Entity\RaidEvent;
use App\Entity\RaidGroup;
use App\Entity\Signup;
use App\Entity\User;
use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\PersistentCollection;

class SignUpService
{
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var SignupRepository
     */
    private $signUpRepository;

    public function __construct(CharacterRepository $characterRepository, SignupRepository $signupRepository)
    {
        $this->characterRepository = $characterRepository;
        $this->signUpRepository = $signupRepository;
    }

    public function classifySignUpsByRaid(RaidEvent $event): array
    {
        $cancellations = [];
        $noFeedback = [];
        $allCharacters = $this->characterRepository->findBy(['hidden' => false], ['spec' => 'ASC', 'class' => 'ASC']);
        foreach ($allCharacters as $character) {
            $noFeedback[$character->getId()] = $character;
        }

        $signUps = $this->signUpRepository->findByRaid($event);
        /**
         * @var integer $index
         * @var  Signup $signUp
         */
        foreach ($signUps as $index => $signUp) {
            if ($signUp->getSignedUp() === 2) {
                $cancellations[$signUp->getPlayerName()->getId()] = $signUp->getPlayerName();
                unset($signUps[$index], $noFeedback[$signUp->getPlayerName()->getId()]);
            }
            if ($signUp->getSignedUp() === 1) {
                unset($noFeedback[$signUp->getPlayerName()->getId()]);
            }
        }
        return [
            'signUps' => $signUps,
            'cancellations' => $cancellations,
            'noFeedback' => $noFeedback
        ];
    }

    public static function findRaidSignUpEnd(string $start): DateTime
    {
        $eventStart = DateTime::createFromFormat('Y-m-d', $start, new DateTimeZone('Europe/Berlin'));
        $eventStart->modify('last tuesday 8pm');
        return $eventStart;
    }

    public static function findCharsInSetup($setup, array $characters): array
    {
        $charEventMatrix = [];
        /** @var RaidGroup $raidGroup */
        foreach ($setup as $raidGroup) {
            foreach ($raidGroup->getSetup()['groups'] as $groupIndex => $group) {
                foreach ($group as $playerIndex => $playerId) {
                    $playerId = (int)$playerId;
                    if (array_key_exists($playerId, $characters)) {
                        $charEventMatrix[$raidGroup->getId()][$playerId] = $characters[$playerId];
                    }
                }
            }
        }
        return $charEventMatrix;
    }
}