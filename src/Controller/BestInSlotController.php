<?php

namespace App\Controller;

use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Utility\WowClassUtility;
use App\Utility\WowRaceUtility;
use App\Utility\WowSpecUtility;
use App\Utility\WoWZoneUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestInSlotController extends AbstractController
{
    /**
     * @var CharacterLootRequirementRepository
     */
    private $bisRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(
        CharacterLootRequirementRepository $characterLootRequirementRepository,
        CharacterRepository $characterRepository,
        ItemRepository $itemRepository
    )
    {
        $this->bisRepository = $characterLootRequirementRepository;
        $this->characterRepository = $characterRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * @Route("/bis", name="best_in_slot")
     * @param WowClassUtility $wowClassUtility
     * @param WowRaceUtility $wowRaceUtility
     * @return Response
     */
    public function indexAction(WowClassUtility $wowClassUtility, WowRaceUtility $wowRaceUtility): Response
    {
        $bisListAndPlayers = [];
        $chars = $this->characterRepository->findAll();
        foreach ($chars as $char) {
            $bisItems = $char->getLootRequirements();
            $bisList = [
                1 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                2 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                3 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                5 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                6 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                7 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                8 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                9 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                10 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                11 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                12 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                13 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                14 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                15 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
                16 => [
                    1 => null,
                    2 => null,
                    3 => null
                ],
            ];
            foreach ($bisItems as $bisItem) {
                $bisList[$bisItem->getSlot()][$bisItem->getPriority()] = $bisItem;
            }
            $bisListAndPlayers[$char->getClass()][] = [
                'char' => $char,
                'bisList' => $bisList
            ];
        }
        return $this->render('best_in_slot/index.html.twig', [
            'bis' => $bisListAndPlayers,
            'classUtility' => $wowClassUtility,
            'raceUtility' => $wowRaceUtility
        ]);
    }

    /**
     * @Route("/bis/mostwanted", name="bis_most_wanted")
     * @return Response
     */
    public function mostWantedAction(): Response
    {
        $mostWantedItems = $this->bisRepository->findMostWantedItems();
        return $this->render('best_in_slot/most-wanted.html.twig', ['mostWantedItems' => $mostWantedItems]);
    }

    /**
     * @Route("/bis/needbyitem/{itemId}", name="bis_need_by_item")
     * @param int $itemId
     * @param WowClassUtility $wowClassUtility
     * @param WowRaceUtility $wowRaceUtility
     * @return Response
     */
    public function needByItem(int $itemId, WowClassUtility $wowClassUtility, WowRaceUtility $wowRaceUtility): Response
    {
        $item = $this->itemRepository->find($itemId);
        $chars = $this->bisRepository->findBy(
            [
                'item' => $item,
                'hasItem' => false
            ]
        );
        foreach ($chars as $index => $char) {
            if ($char->getPlayerCharacter()->getHidden() === true) {
                unset($chars[$index]);
            }
        }
        return $this->render('best_in_slot/need-by-item.html.twig',
            [
                'chars' => $chars,
                'item' => $item,
                'classUtility' => $wowClassUtility,
                'raceUtility' => $wowRaceUtility
            ]
        );
    }

    /**
     * @Route("/bis/needbyzone/{zoneId?}", name="bis_need_by_zone")
     * @param $zoneId
     * @param WowSpecUtility $wowSpecUtility
     * @param WoWZoneUtility $wowZoneUtility
     * @return Response
     */
    public function needByZone($zoneId, WowSpecUtility $wowSpecUtility, WoWZoneUtility $wowZoneUtility): Response
    {
        $bisItems = null;
        $class = 0;
        if (isset($_GET['class'])) {
            $class = (int)$_GET['class'];
        }
        if ((int)$zoneId > 0) {
            $bisItems = $this->bisRepository->findItemsByZoneId($zoneId, $class);
        }
        $items = $this->bisRepository->findItemsByZone();
        return $this->render('best_in_slot/need-by-zone.html.twig', [
            'zones' => $wowZoneUtility,
            'specs' => $wowSpecUtility,
            'items' => $items,
            'bisItems' => $bisItems,
            'zone' => $zoneId,
            'class' => $class
        ]);
    }
}
