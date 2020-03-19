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
use Symfony\Contracts\Translation\TranslatorInterface;


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
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     * @param TranslatorInterface $translator
     */
    public function __construct(
        FactoryInterface $factory,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage,
        TranslatorInterface $translator
    ) {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
        $this->translator = $translator;
    }

    /**
     * @return MenuItem
     */
    public function mainDefault(): MenuItem
    {
        $menu = $this->factory->createItem('root');
        $menu->addChild(
            'news',
            [
                'label' => 'Forum',
                'uri' => 'https://forum.askeria.net',
                'extras' => [
                    'icon' => 'newspaper',
                ],
            ]
        );
        $menu->addChild(
            'raids',
            [
                'label' => $this->translator->trans('Raids'),
                'route' => 'raid',
                'extras' => [
                    'icon' => 'biohazard',
                ],
            ]
        );
        $menu['raids']->addChild(
            'raid_calendar',
            [
                'label' => $this->translator->trans('Calendar'),
                'route' => 'page_calendar',
                'extras' => [
                    'icon' => 'calendar-alt',
                ],
            ]
        );
        $menu['raids']->addChild(
            'raid_signup',
            [
                'label' => $this->translator->trans('SignUp'),
                'route' => 'raid_signup',
                'extras' => [
                    'icon' => 'user-plus',
                ],
            ]
        );
        if ($this->authorizationChecker->isGranted('ROLE_RAIDMANAGER')) {
            $menu['raids']->addChild(
                'raid_signup_cancelbyclass',
                [
                    'label' => 'Missing Feedback',
                    'route' => 'raid_signup_cancelbyclass',
                    'extras' => [
                        'icon' => 'comment-slash',
                    ],
                ]
            );
        }
        $menu->addChild(
            'roster',
            [
                'label' => $this->translator->trans('Roster'),
                'route' => 'roster',
                'extras' => [
                    'icon' => 'user',
                ],
            ]
        );
        $menu['roster']->addChild(
            'roster-recipe',
            [
                'label' => $this->translator->trans('Recipes'),
                'route' => 'roster_recipe',
                'extras' => [
                    'icon' => 'receipt',
                ],
            ]
        );
        $menu['roster']->addChild(
            'roster-bank',
            [
                'label' => $this->translator->trans('Guildbank'),
                'route' => 'bank',
                'extras' => [
                    'icon' => 'dollar-sign',
                ],
            ]
        );
        $menu->addChild(
            'bis',
            [
                'label' => $this->translator->trans('Best In Slot'),
                'route' => 'best_in_slot',
                'extras' => [
                    'icon' => 'check-circle',
                ],
            ]
        );
        $menu['bis']->addChild(
            'bis-most-wanted',
            [
                'label' => $this->translator->trans('Most Wanted Items'),
                'route' => 'bis_most_wanted',
                'extras' => [
                    'icon' => 'star',
                ],
            ]
        );
        $menu['bis']->addChild(
            'bis-by-zone',
            [
                'label' => $this->translator->trans('Need by Zone'),
                'route' => 'bis_need_by_zone',
                'extras' => [
                    'icon' => 'map',
                ],
            ]
        );
        $menu['bis']->addChild(
            'drops-by-zone',
            [
                'label' => $this->translator->trans('Drops by Zone'),
                'route' => 'bis_drops_by_zone',
                'extras' => [
                    'icon' => 'cart-arrow-down',
                ],
            ]
        );
        if ($this->authorizationChecker->isGranted('ROLE_RAIDMANAGER') || $this->authorizationChecker->isGranted('ROLE_LOOTTRACKER')) {
            $menu->addChild(
                'management',
                [
                    'label' => $this->translator->trans('Management Tools'),
                    'uri' => '#',
                    'extras' => [
                        'icon' => 'tools',
                    ],
                ]
            );
            if ($this->authorizationChecker->isGranted('ROLE_RAIDMANAGER_TABC')) {
                $menu['management']->addChild(
                    'upload',
                    [
                        'label' => $this->translator->trans('Upload Raidtracker File (Thunder Ale Brewing Co.)'),
                        'route' => 'page_upload',
                        'extras' => [
                            'icon' => 'upload',
                        ],
                    ]
                );
            }
            if ($this->authorizationChecker->isGranted('ROLE_LOOTTRACKER')) {
                $menu['management']->addChild(
                    'uploaddkp',
                    [
                        'label' => $this->translator->trans('Set DKP String (Askeria)'),
                        'route' => 'page_upload_dkp',
                        'extras' => [
                            'icon' => 'upload',
                        ],
                    ]
                );
            }
            $menu['management']->addChild(
                'groupbuilder',
                [
                    'label' => 'GroupBuilder',
                    'route' => 'group_index',
                    'extras' => [
                        'icon' => 'users',
                    ],
                ]
            );
            $menu['management']->addChild(
                'questHeads',
                [
                    'label' => 'Quest Heads',
                    'route' => 'quest_head',
                    'extras' => [
                        'icon' => 'horse-head',
                    ],
                ]
            );
            $menu['management']->addChild(
                'bank-upload',
                [
                    'label' => 'Update bank',
                    'route' => 'bank_upload',
                    'extras' => [
                        'icon' => 'dollar-sign',
                    ],
                ]
            );
        }
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild(
                'admin',
                [
                    'label' => $this->translator->trans('Admin Area'),
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
            /** @noinspection NullPointerExceptionInspection */
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
            if ($this->authorizationChecker->isGranted('ROLE_RAIDER')) {
                $menu->addChild(
                    'add_character',
                    [
                        'label' => $this->translator->trans('My characters'),
                        'route' => 'profile_character',
                        'extras' => [
                            'icon' => 'users',
                        ],
                    ]
                );
            }
            $menu->addChild(
                'logout',
                [
                    'route' => 'fos_user_security_logout',
                    'label' => $this->translator->trans('Logout'),
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
                    'label' => $this->translator->trans('Login'),
                    'extras' => [
                        'icon' => 'unlock',
                    ],
                ]
            )->setLinkAttribute('class', 'btn btn-primary');
            $menu->addChild(
                'register',
                [
                    'route' => 'fos_user_registration_register',
                    'label' => $this->translator->trans('Sign Up'),
                    'extras' => [
                        'icon' => 'sign-in-alt',
                    ],
                ]
            )->setLinkAttribute('class', 'btn btn-outline-primary');
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
                'label' => $this->translator->trans('Privacy Policy'),
                'route' => 'page_privacy'
            ]
        );
        $menu->addChild(
            'legal',
            [
                'label' => $this->translator->trans('Legal Information'),
                'route' => 'page_legal'
            ]
        );
        return $menu;
    }
}
