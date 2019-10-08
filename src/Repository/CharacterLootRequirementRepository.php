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
GROUP BY bis.item_id
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
}
