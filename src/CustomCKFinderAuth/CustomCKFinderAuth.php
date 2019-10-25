<?php

namespace App\CustomCKFinderAuth;

use CKSource\Bundle\CKFinderBundle\Authentication\Authentication as AuthenticationBase;

class CustomCKFinderAuth extends AuthenticationBase
{
    public function authenticate(): bool
    {
        $tokenStorage = $this->container->get('security.token_storage');
        if (!$tokenStorage) {
            return false;
        }
        $token = $tokenStorage->getToken();
        return $token && in_array('ROLE_ADMIN', $token->getRoleNames(), true);
    }
}