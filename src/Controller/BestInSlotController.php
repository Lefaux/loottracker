<?php

namespace App\Controller;

use App\Entity\Character;
use App\Repository\CharacterLootRequirementRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\LootRepository;
use App\Utility\WowClassUtility;
use App\Utility\WowRaceUtility;
use App\Utility\WowSlotUtility;
use App\Utility\WowSpecUtility;
use App\Utility\WoWZoneUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @var LootRepository
     */
    private $lootRepository;

    public function __construct(
        CharacterLootRequirementRepository $characterLootRequirementRepository,
        CharacterRepository $characterRepository,
        ItemRepository $itemRepository,
        LootRepository $lootRepository
    )
    {
        $this->bisRepository = $characterLootRequirementRepository;
        $this->characterRepository = $characterRepository;
        $this->itemRepository = $itemRepository;
        $this->lootRepository = $lootRepository;
    }

    /**
     * @Route("/bis", name="best_in_slot")
     * @param Request $request
     * @param WowClassUtility $wowClassUtility
     * @param WowRaceUtility $wowRaceUtility
     * @param WowSlotUtility $wowSlotUtility
     * @return Response
     */
    public function indexAction(Request $request, WowClassUtility $wowClassUtility, WowRaceUtility $wowRaceUtility, WowSlotUtility $wowSlotUtility): Response
    {
        $filters = $request->get('f');
        if (!is_array($filters)) {
            $filters = [];
        }
        if (!isset($filters['phase'])) {
            $filters['phase'] = [
                1 => true,
                3 => true,
            ];
        }
        if (!isset($filters['class'])) {
            $filters['class'] = [
                1 => true
            ];
        }
        $bisListAndPlayers = [];
        $bisItems = [];
        $bisList = [];
        $characters = $this->characterRepository->findByClass($filters);
        $cleanedFilters = $filters;
        unset($cleanedFilters['phase'], $cleanedFilters['rank'], $cleanedFilters['slot'], $cleanedFilters['spec']);
        $cleanedFilters['rank']['twink'] = 1;
        $unFilteredCharacters = $this->characterRepository->findByClass($cleanedFilters);
        $filteredCharacters = array_diff($unFilteredCharacters, $characters);
        $usedSlots = [];
        $maxPhaseItems = $this->bisRepository->findBiSByFilter($filters, false);
        foreach ($maxPhaseItems as $maxPhaseItem) {
            if ($maxPhaseItem['priority'] < 10) {
                $maxPhaseItem['priority'] += 10;
            }
            switch ($maxPhaseItem['priority']) {
                case 11:
                case 21:
                case 31:
                case 41:
                case 51:
                case 61:
                    $maxSlotId = 'maxA';
                    break;
                case 12:
                case 22:
                case 32:
                case 42:
                case 52:
                case 62:
                    $maxSlotId = 'maxB';
                    break;
                case 13:
                case 23:
                case 33:
                case 43:
                case 53:
                case 63:
                    $maxSlotId = 'maxC';
                    break;
                case 14:
                case 24:
                case 34:
                case 44:
                case 54:
                case 64:
                    $maxSlotId = 'maxD';
                    break;
                default:
                    $maxSlotId = 'missing';
            }
            $bisList[$maxPhaseItem['player_character_id']][$maxPhaseItem['slot']][$maxSlotId] = $this->bisRepository->find($maxPhaseItem['id']);
        }
        $items = $this->bisRepository->findBiSByFilter($filters);
        foreach ($items as $item) {
            if (!in_array($item['item_id'], $bisItems, true)) {
                $bisItem = $this->bisRepository->find($item['id']);
                if ($bisItem) {
                    $bisList[$item['player_character_id']][$bisItem->getSlot()][$bisItem->getPriority()] = $bisItem;
                    $usedSlots[$bisItem->getSlot()] = true;
                }
                $bisItems[$item['item_id']] = $bisItem;
            }
        }
        ksort($usedSlots);
        /** @var Character $character */
        foreach ($characters as $character) {
            if (!isset($bisList[$character->getId()])) {
                $bisList[$character->getId()] = [];
            }
            $bisListAndPlayers[$character->getClass()][] = [
                'char' => $character,
                'bisList' => $bisList[$character->getId()]
            ];
        }
        return $this->render('best_in_slot/index.html.twig', [
            'bis' => $bisListAndPlayers,
            'usedSlots' => $usedSlots,
            'filters' => $filters,
            'classUtility' => $wowClassUtility,
            'raceUtility' => $wowRaceUtility,
            'slotUtility' => $wowSlotUtility,
            'filteredCharacters' => $filteredCharacters
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
            if ($char->getPlayerCharacter() && $char->getPlayerCharacter()->getHidden() === true) {
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
     * @Route("/bis/dropbyzone/{zoneId?}", name="bis_drops_by_zone")
     * @param $zoneId
     * @param WowSpecUtility $wowSpecUtility
     * @param WoWZoneUtility $wowZoneUtility
     * @return Response
     */
    public function dropsCountAction($zoneId, WowSpecUtility $wowSpecUtility, WoWZoneUtility $wowZoneUtility): Response
    {
        $bisItems = null;
        $class = 0;
        $items = $this->lootRepository->countItemsByZone((int)$zoneId);
        foreach ($items as $index => $item) {
            $bisItems[$item['className']][$item['subClassName']][] = $item;
        }
        $itemsInZones = $this->lootRepository->countZone();
        return $this->render('best_in_slot/drop-by-zone.html.twig', [
            'zones' => $wowZoneUtility,
            'specs' => $wowSpecUtility,
            'items' => $bisItems,
            'itemsInZones' => $itemsInZones,
            'zone' => $zoneId,
            'class' => $class
        ]);
    }

    /**
     * @Route("/bis/needbyzone/{zoneId?}", name="bis_need_by_zone")
     * @param Request $request
     * @param $zoneId
     * @param WowSpecUtility $wowSpecUtility
     * @param WoWZoneUtility $wowZoneUtility
     * @return Response
     */
    public function needByZone(Request $request, $zoneId, WowSpecUtility $wowSpecUtility, WoWZoneUtility $wowZoneUtility): Response
    {
        $filters = $request->get('f');
        if (!is_array($filters)) {
            $filters = [];
        }
        if (!isset($filters['class'])) {
            $filters['class'] = [
                1 => true,
                2 => true,
                3 => true,
                4 => true,
                5 => true,
                6 => true,
                7 => true,
                9 => true,
            ];
        }
        if (!isset($filters['rank'])) {
            $filters['rank'] = [
                '7,1,3' => true,
            ];
        }
        $bisItems = $this->bisRepository->findItemsByZoneId($filters);
        return $this->render('best_in_slot/need-by-zone.html.twig', [
            'zones' => $wowZoneUtility,
            'specs' => $wowSpecUtility,
            'bisItems' => $bisItems,
            'zone' => $zoneId,
            'filters' => $filters
        ]);
    }
}
