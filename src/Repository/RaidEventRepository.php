<?php

namespace App\Repository;

use App\Entity\RaidEvent;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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

    public function findEventsInGivenMonth(DateTimeInterface $start, DateTimeInterface $end)
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.start > :start AND e.end < :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery();

        return $qb->execute();
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
