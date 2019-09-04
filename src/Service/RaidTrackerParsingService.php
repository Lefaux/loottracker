<?php


namespace App\Service;


use App\Entity\Attendance;
use App\Entity\Character;
use App\Entity\Item;
use App\Entity\Loot;
use App\Entity\Raid;
use App\Repository\AttendanceRepository;
use App\Repository\CharacterRepository;
use App\Repository\ItemRepository;
use App\Repository\LootRepository;
use App\Repository\RaidRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

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
     * @var AttendanceRepository
     */
    private $attendanceRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    public function __construct(
        RaidRepository $raidRepository,
        LootRepository $lootRepository,
        CharacterRepository $characterRepository,
        AttendanceRepository $attendanceRepository,
        ItemRepository $itemRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->raidRepository = $raidRepository;
        $this->lootRepository = $lootRepository;
        $this->characterRepository = $characterRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->itemRepository = $itemRepository;
        $this->entityManager = $entityManager;
    }

    public function parse(string $filename): void
    {
        $fileContent = file_get_contents($filename);
        $parser = new LuaParser($fileContent);
        $raids = $parser->parse();
        foreach ($raids['CT_RaidTracker_RaidLog'] as $raid) {
            $this->parseRaid($raid);
        }
    }

    private function parseRaid(array $raidData): void
    {
        $raid = $this->findOrCreateRaidByKey($raidData['key']);
        $this->insertAttendance($raidData['Join'], $raid);
        $this->insertLoot($raidData['Loot'], $raid);
    }

    private function findOrCreateRaidByKey(string $key): Raid
    {
        $raidDateTime = $this->getDateTimeFromWoWStrings($key);
        $raid = $this->raidRepository->findBy([
            'date' => $raidDateTime
        ]);
        if (count($raid) === 0) {
            // insert new raid
            $raid = new Raid();
            $raid->setDate($raidDateTime);
            $raid->setNote($raidDateTime->format('D, d.m.Y H:i'));
            $this->entityManager->persist($raid);
            $this->entityManager->flush();
        } elseif (count($raid) > 1) {
            throw new \RuntimeException('Duplicate raid found for "' . $key  . '"');
        } else {
            $raid = $raid[0];
        }
        return $raid;
    }

    private function insertAttendance(array $attendance, Raid $raid): void
    {
        $attendees = [];
        foreach ($attendance as $item) {
            if (!array_key_exists($item['player'], $attendees)) {
                $attendees[$item['player']] = $this->getDateTimeFromWoWStrings($item['time']);
            }
        }
        foreach ($attendees as $charName => $joined) {
            $char = $this->characterRepository->findBy(['name' => $charName]);
            if (count($char) === 0) {
                $character = new Character();
                $character->setName($charName);
                $character->setClass(0);
                $character->setSpec(0);
                $this->entityManager->persist($character);
                $this->entityManager->flush();
            } else {
                $character = $char[0];
            }
            $insertedBefore = $this->attendanceRepository->findBy([
                'player' => $character,
                'raidnight' => $raid
            ]);
            if (empty($insertedBefore)) {
                $raidJoin = new Attendance();
                $raidJoin->setPlayer($character);
                $raidJoin->setRaidnight($raid);
                $this->entityManager->persist($raidJoin);
            }
        }
        $this->entityManager->flush();
    }

    private function insertLoot(array $loot, Raid $raid): void
    {
        foreach ($loot as $lootedItem) {
            $player = $this->characterRepository->findBy(['name' => $lootedItem['player']]);
            if (count($player) === 0) {
                throw new \RuntimeException('player "' . $lootedItem['player'] . '" not found in DB');
            }
            $player = $player[0];
            $timeStamp = $this->getDateTimeFromWoWStrings($lootedItem['time']);
            $item = $this->getItemByWeirdString($lootedItem['item']['id']);
            if ($item->getQuality() > 3) {
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
    }

    private function getItemByWeirdString(string $weirdString): Item
    {
        $itemParts = explode(':', $weirdString);
        $item = $this->itemRepository->find($itemParts[0]);
        if ($item) {
            return $item;
        }
        throw new \RuntimeException('No item in DB for "' . $weirdString . '"');
    }

    private function getDateTimeFromWoWStrings(string $wowTime): DateTime
    {
        $dateTime = DateTime::createFromFormat('m/d/y H:i:s', $wowTime);
        if (!empty($dateTime)) {
            return $dateTime;
        }
        throw new \RuntimeException('Date mis-formatted with "' . $wowTime  . '"');
    }
}