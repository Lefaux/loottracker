<?php


namespace App\Listener;


use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\Security\Core\Security;

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
            $characters = $this->characterRepository->findBy(['account' => $user, 'hidden' => false]);
            $check = $this->signUpRepository->checkIfCharIsSignedUpForAllEvents($characters);
            if ($check === false && !isset($GLOBALS['askeria-flash-message-signup'])) {
                $this->session->getFlashBag()->add('danger', '<h3>There are events you haven\'t signup up for or cancelled yet.<br><a href="/raid/signup" class="btn btn-danger">Click here</a></h3>');
                $GLOBALS['askeria-flash-message-signup'] = true;
            }
        }
    }
}