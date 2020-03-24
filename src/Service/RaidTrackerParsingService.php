<?php

namespace App\Service;

use App\Entity\Item;
use App\Entity\Loot;
use App\Entity\Raid;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\LootRepository;
use App\Repository\RaidRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;

class RaidTrackerParsingService
{
    /**
     * @var RaidRepository
     */
    private $raidRepository;
    /**
     * @var LootRepository
     */
    private $lootRepository;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    private $specialCharacterMappingBullshit = [
        'øleg' => 'Øleg'
    ];

    public function __construct(
        RaidRepository $raidRepository,
        LootRepository $lootRepository,
        CharacterRepository $characterRepository,
        ItemRepository $itemRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->raidRepository = $raidRepository;
        $this->lootRepository = $lootRepository;
        $this->characterRepository = $characterRepository;
        $this->itemRepository = $itemRepository;
        $this->entityManager = $entityManager;
    }

    public function parseDkpString(array $dkpString): array
    {
        $raids = [];
        $importedRaids = [];
        foreach ($dkpString as $lootedItem) {
            /**
             * Fix special character naming because yeah, fancy bullshit kiddo special characters
             * God should kill UTF8 and those to abuse it
             */
            $normalizedCharacterName = ucfirst(str_replace('-Razorfen', '', $lootedItem['player']));
            if (array_key_exists($normalizedCharacterName, $this->specialCharacterMappingBullshit)) {
                $normalizedCharacterName = $this->specialCharacterMappingBullshit[$normalizedCharacterName];
            }


            $timestamp = DateTime::createFromFormat('d.m.y H:i:s', $lootedItem['date'] . ' ' . $lootedItem['time']);
            if (array_key_exists($lootedItem['instance'], $raids) && $timestamp < $raids[$lootedItem['instance']]['datetime']) {
                $raids[$lootedItem['instance']]['datetime'] = $timestamp;
            }
            if (!array_key_exists($lootedItem['instance'], $raids)) {
                $raids[$lootedItem['instance']]['datetime'] = new DateTime('now');
                $raids[$lootedItem['instance']]['zone'] = $lootedItem['instance'];
            }
            $raids[$lootedItem['instance']]['loots'][] = [
                'player' => $normalizedCharacterName,
                'item' => $lootedItem['itemID'],
                'timestamp' => $timestamp
            ];
        }
        foreach ($raids as $raidEntry) {
            $raid = $this->findOrCreateRaidByKey($raidEntry);
            $raid = $this->insertLoot($raidEntry['loots'], $raid);
            $importedRaids[] = $raid;
        }

        return $importedRaids;
    }

    private function findOrCreateRaidByKey(array $raidEntry): Raid
    {
        $raid = $this->raidRepository->findBy([
            'zone' => $raidEntry['zone'],
            'date' => $raidEntry['datetime']
        ]);
        if (count($raid) === 0) {
            // insert new raid
            $raid = new Raid();
            $raid->setDate($raidEntry['datetime']);
            $raid->setNote($raidEntry['zone'] .' ' . $raidEntry['datetime']->format('D, d.m.Y H:i'));
            $raid->setZone($raidEntry['zone']);
            $this->entityManager->persist($raid);
            $this->entityManager->flush();
        } elseif (count($raid) > 1) {
            throw new RuntimeException('Duplicate raid found for "' . $raidEntry['zone']  . ' at ' . $raidEntry['datetime']->format('D, d.m.Y H:i')  . ' "');
        } else {
            $raid = $raid[0];
        }
        return $raid;
    }

    private function insertLoot(array $loot, Raid $raid): Raid
    {
        foreach ($loot as $lootedItem) {
            $player = $this->characterRepository->findBy(['name' => $lootedItem['player']]);
            if (count($player) === 0) {
                throw new RuntimeException('player "' . $lootedItem['player'] . '" not found in DB');
            }
            $player = $player[0];
            $timeStamp = $lootedItem['timestamp'];
            $item = $this->itemRepository->find($lootedItem['item']);
            if ($item && $item->getQuality() > 3) {
                $existingLootEntry = $this->lootRepository->findBy([
                    'raid' => $raid,
                    'date' => $timeStamp,
                    'player' => $player,
                    'item' => $item
                ]);
                if (empty($existingLootEntry)) {
                    $lootEntry = new Loot();
                    $lootEntry->setRaid($raid);
                    $lootEntry->setDate($timeStamp);
                    $lootEntry->setItem($item);
                    $lootEntry->setPlayer($player);
                    $this->entityManager->persist($lootEntry);
                    $this->entityManager->flush();
                }
            }
        }
        return $raid;
    }
}