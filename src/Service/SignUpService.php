<?php


namespace App\Service;

use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;

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
                $cancellations[] = $signUp->getPlayerName();
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
}