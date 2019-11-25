<?php

namespace App\Repository;

use App\Entity\RaidGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RaidGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaidGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaidGroup[]    findAll()
 * @method RaidGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaidGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RaidGroup::class);
    }

    // /**
    //  * @return RaidGroup[] Returns an array of RaidGroup objects
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
    public function findOneBySomeField($value): ?RaidGroup
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
