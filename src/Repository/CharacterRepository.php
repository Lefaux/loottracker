<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Character|null find($id, $lockMode = null, $lockVersion = null)
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 * @method Character[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * @return Character[]
     */
    public function findAll(): array
    {
        return $this->findBy(
            ['hidden' => false],
            ['spec' => 'DESC', 'name' => 'ASC']
        );
    }

    public function findByClass(array $classes): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.hidden = 0')
            ->andWhere('c.class IN (:classIds)')
            ->setParameter('classIds', $classes)
            ->orderBy('c.class')
            ->addOrderBy('c.spec', 'DESC')
            ->addOrderBy('c.name')
            ->getQuery()
            ->getResult()
            ;
    }
}
