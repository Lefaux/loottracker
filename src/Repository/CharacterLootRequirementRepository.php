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

    public function findItemsByZoneId(array $filters): array
    {
        $output = [];
        $constraints = [];
        $constraints['hiddenPlayer'] = 'c.hidden = 0';
        /**
         * Build Filter Constraints
         */
        $constraints[] = 'c.twink IN (:twink)';
        $includeTwinks[] = 0;
        $query = $this->createQueryBuilder('bis')
            ->select('bis')
            ->innerJoin('bis.item', 'i')
            ->innerJoin('bis.playerCharacter', 'c')
            ->where('bis.hasItem = 0');
        // Filter for Character Class
        if (array_key_exists('class', $filters)) {
            $constraints[] = 'c.class IN (:classIds)';
            $query->setParameter('classIds', array_keys($filters['class']));
        }
        // Filter for Character Spec
        if (array_key_exists('spec', $filters)) {
            $constraints[] = 'c.spec IN (:specIds)';
            $query->setParameter('specIds', array_keys($filters['spec']));
        }
        // Filter for Character Rank
        if (array_key_exists('rank', $filters)) {
            $ranksToShow = [];
            foreach ($filters['rank'] as $ranks => $_) {
                if ($ranks === 'twink') {
                    // special twink handling
                    $includeTwinks[] = 1;
                } else {
                    $singleRanks = explode(',', $ranks);
                    foreach ($singleRanks as $singleRank) {
                        $ranksToShow[] = (int)$singleRank;
                    }
                }
            }
            $constraints[] = 'c.rank IN (:rankIds)';
            $query->setParameter('rankIds', $ranksToShow);
        }
        $query->setParameter('twink', $includeTwinks);
        // Apply constraints if available
        if (!empty($constraints)) {
            $query->andWhere(implode(' AND ', $constraints));
        }
        $query = $query->getQuery();

        $bisItems = $query->getResult();
        /** @var CharacterLootRequirement $bisItem */
//        foreach ($bisItems as $bisItem) {
//            $item = $bisItem->getItem();
//            if ($item) {
//                $players = [];
//                $characterLootRequirements = $this->findBy(['item' => $item->getId(), 'hasItem' => false]);
//                foreach ($characterLootRequirements as $characterLootRequirement) {
//                    $character = $characterLootRequirement->getPlayerCharacter();
//                    if ($character && $character->getHidden() === false) {
//                        $players[$character->getSpec()][] = $character;
//                    }
//                }
//                ksort($players);
//                $output[] = [
//                    'item' => $bisItem->getItem(),
//                    'playersWithNeed' => $players
//                ];
//            }
//        }
        foreach ($bisItems as $bisItem) {
            // Counter
            $item = $bisItem->getItem();
            $character = $bisItem->getPlayerCharacter();
            // Guard for items (should never happen but hey...)
            if (!$item && !$character) {
                break;
            }
            $zone = $item->getZone();
            if ($zone < 1) {
                $zone = 0;
            }
            if (!isset($output['zones'][$zone])) {
                $output['zones'][$zone] = 0;
            }
            $output['zones'][$zone]++;
            // Listing
            $output['items'][$zone][$item->getId()]['item'] = $item;
            $output['items'][$zone][$item->getId()]['players'][$character->getSpec()][] = $character;
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
    AND i.hidden = 0
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

    public function findBiSByFilter(array $filters, bool $filterPhases = true): array
    {
        $output = [];
        $constraints = [];
        $constraints['hiddenPlayer'] = 'c.hidden = 0';
        $constraints['hiddenItem'] = 'i.hidden = 0';
        /**
         * Build Filter Constraints
         */
        if (isset($filters['class'])) {
            $constraints['class'] = 'c.class IN ('. implode(', ', array_keys($filters['class']))  .')';
        }
        if (!$filterPhases) {
            $constraints['hasItem'] = 'bis.has_item = 1';
        }
        if ($filterPhases && isset($filters['phase'])) {
            $constraints['phase'] = '(';
            $phaseBlocks = [];
            foreach ($filters['phase'] as $index => $_) {
                if ($index === 1) {
                    $index = '';
                }
                $phaseBlocks[] = ' bis.priority BETWEEN ' . $index . '1 AND ' . $index . '4';
            }
            $constraints['phase'] .= implode(' OR ', $phaseBlocks);
            $constraints['phase'] .= ')';
        }
        if (isset($filters['slot'])) {
            $constraints['slot'] = 'i.inventory_slot IN ('. implode(', ', array_keys($filters['slot']))  .')';
        }

        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT bis.*
FROM character_loot_requirement bis
    INNER JOIN characters c on bis.player_character_id = c.id
    INNER JOIN item i on bis.item_id = i.id
WHERE '. implode(' AND ', $constraints)  .'
ORDER BY c.class, c.spec, bis.priority
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
