<?php

namespace App\Repository;

use App\Entity\RaidEvent;
use Cassandra\Date;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method RaidEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaidEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaidEvent[]    findAll()
 * @method RaidEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaidEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RaidEvent::class);
    }

    /**
     * @param DateTimeInterface $start
     * @param DateTimeInterface $end
     * @return RaidEvent[]
     */
    public function findEventsInGivenMonth(DateTimeInterface $start, DateTimeInterface $end): array
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.start > :start AND e.start < :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery();

        return $qb->execute();
    }

    public function findEventsAndSignUps()
    {
        $output = [];
        $now = new \DateTime('yesterday');
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    e.title,
       e.start,
       e.id,
    (SELECT count(id) FROM signup WHERE signed_up = 1 AND raid_event_id = e.id) as signups,
    (SELECT count(id) FROM signup WHERE signed_up = 2 AND raid_event_id = e.id) as cancellations
FROM raid_event e
WHERE e.start > \''. $now->format('Y.m.d') .'\'
ORDER BY e.start
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
        } catch (DBALException $e) {
        }

        return $output;
    }

    // /**
    //  * @return RaidEvent[] Returns an array of RaidEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RaidEvent
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
