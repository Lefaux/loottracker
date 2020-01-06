<?php

namespace App\Repository;

use App\Entity\CharacterLootRequirement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method CharacterLootRequirement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterLootRequirement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterLootRequirement[]    findAll()
 * @method CharacterLootRequirement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterLootRequirementRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterLootRequirement::class);
    }

    public function findMostWantedItems(): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    count(bis.id) as amount,
    bis.item_id,
    i.name,
    SUM(bis.has_item) as available
FROM
    character_loot_requirement bis
    INNER JOIN item i on i.id = bis.item_id
    INNER JOIN characters c on bis.player_character_id = c.id
WHERE c.hidden = 0
GROUP BY bis.item_id
HAVING amount > available
ORDER BY amount DESC
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
        } catch (DBALException $e) {
        }

        return $output;
    }
    public function findItemsByZone(int $charId = 0): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $charConstraint = '';
        if (is_int($charId) && $charId > 0) {
            $charConstraint = ' AND bis.player_character_id = ' . $charId;
        }
        $sql = '
SELECT 
    count(bis.id) as amount, i.zone
FROM `character_loot_requirement` bis 
    INNER JOIN item i on i.id = bis.item_id 
WHERE bis.has_item = 0 AND i.zone IS NOT NULL ' . $charConstraint .'
GROUP BY i.zone
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
        } catch (DBALException $e) {
        }

        return $output;
    }

    public function findItemsByZoneId(int $zoneId, int $charClass = 0): array
    {
        $output = [];
        $constraint = '';
        $qb = $this->createQueryBuilder('bis');
        if ($charClass > 0) {
            $constraint = ' AND c.class = '.(int)$charClass;
        }
        $query = $qb
            ->select('bis')
            ->innerJoin('bis.item', 'i')
            ->innerJoin('bis.playerCharacter', 'c')
            ->where('bis.hasItem = 0 AND i.zone = :zone AND c.hidden = 0' . $constraint)
            ->groupBy('i.id')
            ->setParameter('zone', $zoneId)
            ->getQuery();
        $bisItems = $query->getResult();
        /** @var CharacterLootRequirement $bisItem */
        foreach ($bisItems as $bisItem) {
            $item = $bisItem->getItem();
            if ($item) {
                $players = [];
                $characterLootRequirements = $this->findBy(['item' => $item->getId(), 'hasItem' => false]);
                foreach ($characterLootRequirements as $characterLootRequirement) {
                    $character = $characterLootRequirement->getPlayerCharacter();
                    if ($character && $character->getHidden() === false) {
                        $players[$character->getSpec()][] = $character;
                    }
                }
                ksort($players);
                $output[] = [
                    'item' => $bisItem->getItem(),
                    'playersWithNeed' => $players
                ];
            }
        }
        return $output;
    }

    public function findItemsByCharId(int $charId): array
    {
        $output = [];
        $qb = $this->createQueryBuilder('bis');
        $query = $qb
            ->select('bis')
            ->innerJoin('bis.item', 'i')
            ->where('bis.hasItem = 0 AND bis.playerCharacter = :char')
            ->setParameter('char', $charId)
            ->getQuery();
        $bisItems = $query->getResult();
        /** @var CharacterLootRequirement $bisItem */
        foreach ($bisItems as $bisItem) {
            $item = $bisItem->getItem();
            if ($item) {
                $zone = $item->getZone();
                if ($zone === null) {
                    $zone = 0;
                }
                $output[$zone][] = $item;
            }
        }
        return $output;
    }

    public function findItemsByRaidGroup(array $playerIds, int $zone): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    count(bis.id) AS amount,
     i.id,
     i.name,
     group_concat(c.id) as characterIds,
     c.rank_id,
     c.twink
FROM
    character_loot_requirement bis
    INNER JOIN item i ON i.id = bis.item_id
    INNER JOIN characters c on bis.player_character_id = c.id
WHERE
    i.zone = '. $zone . '
    AND bis.has_item = 0
    AND c.hidden = 0
    AND bis.player_character_id IN ('. implode(',', $playerIds)  .')
GROUP BY twink,rank_id,bis.item_id
ORDER BY rank_id, amount DESC
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
        } catch (DBALException $e) {
        }

        return $output;
    }
}
