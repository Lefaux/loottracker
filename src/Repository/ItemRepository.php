<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function findMaxImportedItem(): int
    {
        $result = 1;
        $qb = $this->createQueryBuilder('u');
        $qb->select('MAX(u.id) as idMax');
        try {
            $result = $qb->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }
        return (int)$result['idMax'];
    }

    public function searchByName(string $query)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.name LIKE :word')
            ->setParameter('word', '%'.addcslashes($query, '%_').'%')
            ->orderBy('a.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
