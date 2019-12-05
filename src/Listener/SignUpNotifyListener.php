<?php


namespace App\Listener;


use App\Repository\CharacterRepository;
use App\Repository\SignupRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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

    public function onKernelController(): void
    {
        $user = $this->security->getUser();
        if ($user) {
            $characters = $this->characterRepository->findBy(['account' => $user]);
            $check = $this->signUpRepository->checkIfCharIsSignedUpForAllEvents($characters);
            $foo = '';
            if ($check === false && !isset($GLOBALS['askeria-flash-message-signup'])) {
                $this->session->getFlashBag()->add('danger', '<h3>There are events you haven\'t signup up for or cancelled yet.<br><a href="/raid/signup" class="btn btn-danger">Click here</a></h3>');
                $GLOBALS['askeria-flash-message-signup'] = true;
            }
        }
    }
}