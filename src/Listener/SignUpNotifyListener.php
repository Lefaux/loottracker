<?php


namespace App\Listener;


use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class SignUpNotifyListener
{
    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var Security
     */
    private $security;
    /**
     * @var SignupRepository
     */
    private $signUpRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    public function __construct(SessionInterface $session, Security $security, SignupRepository $signupRepository, CharacterRepository $characterRepository)
    {
        $this->session = $session;
        $this->security = $security;
        $this->signUpRepository = $signupRepository;
        $this->characterRepository = $characterRepository;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();
        $name = get_class($controller[0]);
        if ($name === 'App\Controller\Api\SelectController') {
            return;
        }
        if ($name === 'App\Controller\RaidSignupController') {
            return;
        }
        $user = $this->security->getUser();
        if ($user) {
            $this->nagForMissingRaidSignUps($user);
            $this->nagForMissingAllegiance($user);
            $this->nagForMissingSpec($user);
        }
    }

    /**
     * @param UserInterface $user
     */
    private function nagForMissingRaidSignUps(UserInterface $user): void
    {
        $characters = $this->characterRepository->findBy(['account' => $user, 'hidden' => false]);
        $check = $this->signUpRepository->checkIfCharIsSignedUpForAllEvents($characters);
        if ($check === false && !isset($GLOBALS['askeria-flash-message-signup'])) {
            $this->session->getFlashBag()->add('danger', '<h3>There are events you haven\'t signup up for or cancelled yet.<br><a href="/raid/signup" class="btn btn-danger">Click here</a></h3>');
            $GLOBALS['askeria-flash-message-signup'] = true;
        }
    }

    private function nagForMissingAllegiance(UserInterface $user): void
    {
        $characters = $this->characterRepository->findBy(['account' => $user, 'hidden' => false]);
        foreach ($characters as $character) {
            if ($character->getAllegience() === null || $character->getAllegience() === 'none') {
                $this->session->getFlashBag()->add('danger', '<h3>Missing info on Aldor/Scryer allegiance. Please set it for "' . $character->getName() . '"</h3>');
            }
        }
    }

    private function nagForMissingSpec(UserInterface $user): void
    {
        $characters = $this->characterRepository->findBy(['account' => $user, 'hidden' => false]);
        foreach ($characters as $character) {
            if ($character->getSpec() < 4) {
                $this->session->getFlashBag()->add('danger', '<h3>Please set the spec for "' . $character->getName() . '"</h3>');
            }
        }
    }
}