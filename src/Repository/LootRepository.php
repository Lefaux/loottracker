<?php

namespace App\Repository;

use App\Entity\Loot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method Loot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Loot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Loot[]    findAll()
 * @method Loot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Loot::class);
    }

    public function countItemsByZone(int $zoneId): array
    {
        $output = [];
        $zoneConstraint = '';
        if ($zoneId > 0) {
            $zoneConstraint = ' AND i.zone = ' . $zoneId;
        }
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT 
    count(loot.id) as amount, loot.item_id, i.name, i.zone, i.sub_class_id, i.class_id, sc.name AS subClassName, c.name AS className
FROM loot
    INNER JOIN item i on i.id = loot.item_id
    INNER JOIN sub_category sc on i.sub_class_id = sc.id
    INNER JOIN category c on i.class_id = c.id
WHERE 1 ' . $zoneConstraint .'
GROUP BY i.id
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

    public function countZone(): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT 
    count(loot.id) as amount, i.zone
FROM loot
    INNER JOIN item i on i.id = loot.item_id
WHERE 1
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
}
