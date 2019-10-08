<?php
declare(strict_types=1);

/*
 * This file is part of the package t3g/forger.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


/**
 * MenuBuilder
 */
class MenuBuilder
{
    /**
     * @var MenuFactory
     */
    private $factory;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        FactoryInterface $factory,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage
    ) {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return MenuItem
     */
    public function mainDefault(): MenuItem
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild(
            'raids',
            [
                'label' => 'Raids',
                'route' => 'raid',
                'extras' => [
                    'icon' => 'biohazard',
                ],
            ]
        );
        $menu->addChild(
            'roster',
            [
                'label' => 'Roster',
                'route' => 'roster',
                'extras' => [
                    'icon' => 'user',
                ],
            ]
        );
        $menu->addChild(
            'bis',
            [
                'label' => 'Best In Slot',
                'route' => 'best_in_slot',
                'extras' => [
                    'icon' => 'check-circle',
                ],
            ]
        );
        $menu['bis']->addChild(
            'bis-most-wanted',
            [
                'label' => 'Most Wanted Items',
                'route' => 'bis_most_wanted',
                'extras' => [
                    'icon' => 'star',
                ],
            ]
        );
        if ($this->authorizationChecker->isGranted('ROLE_RAIDMANAGER')) {
            $menu->addChild(
                'management',
                [
                    'label' => 'Management Tools',
                    'uri' => '#',
                    'extras' => [
                        'icon' => 'tools',
                    ],
                ]
            );
            $menu['management']->addChild(
                'upload',
                [
                    'label' => 'Upload Raidtracker File',
                    'route' => 'page_upload',
                    'extras' => [
                        'icon' => 'upload',
                    ],
                ]
            );
            $menu['management']->addChild(
                'uploaddkp',
                [
                    'label' => 'Set DKP String',
                    'route' => 'page_upload_dkp',
                    'extras' => [
                        'icon' => 'upload',
                    ],
                ]
            );
        }
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild(
                'admin',
                [
                    'label' => 'Admin Area',
                    'uri' => '/admin',
                    'extras' => [
                        'icon' => 'clipboard-list',
                    ],
                ]
            );
        }
        return $menu;
    }

    /**
     * @return MenuItem
     */
    public function mainProfile(): MenuItem
    {
        $menu = $this->factory->createItem('root');
        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild(
                'username',
                [
                    'label' => $this->tokenStorage->getToken()->getUsername(),
                    'uri' => '#',
                    'extras' => [
                        'icon' => 'user',
                    ],
                ]
            );
            $menu->addChild(
                'logout',
                [
                    'route' => 'fos_user_security_logout',
                    'label' => 'Logout',
                    'extras' => [
                        'icon' => 'lock',
                    ],
                ]
            )->setLinkAttribute('class', 'btn btn-primary');
        } else {
            $menu->addChild(
                'login',
                [
                    'route' => 'fos_user_security_login',
                    'label' => 'Login',
                    'extras' => [
                        'icon' => 'unlock',
                    ],
                ]
            )->setLinkAttribute('class', 'btn btn-primary');
            $menu->addChild(
                'register',
                [
                    'route' => 'fos_user_registration_register',
                    'label' => 'Sign Up',
                    'extras' => [
                        'icon' => 'sign-in-alt',
                    ],
                ]
            )->setLinkAttribute('class', 'btn btn-outline-primary');
        }
        if ($this->authorizationChecker->isGranted('ROLE_RAIDER')) {
            $menu['username']->addChild(
                'add_character',
                [
                    'label' => 'My characters',
                    'route' => 'profile_character',
                    'extras' => [
                        'icon' => 'users',
                    ],
                ]
            );
        }
        return $menu;
    }

    /**
     * @return MenuItem
     */
    public function mainFooter(): MenuItem
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild(
            'privacy',
            [
                'label' => 'Privacy Policy',
                'route' => 'page_privacy'
            ]
        );
        $menu->addChild(
            'legal',
            [
                'label' => 'Legal Information',
                'route' => 'page_legal'
            ]
        );
        return $menu;
    }
}
