<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function findDistinctIcons(): array
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->select('i.icon')
            ->groupBy('i.icon')
//            ->setMaxResults(2)
        ;
        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @param string $query
     * @param string $slots
     * @return array|Item[]
     */
    public function searchByName(string $query, string $slots): array
    {
        switch ($slots) {
            case '13':
                $searchSlots = [
                    13,17,21
                ];
                break;
            case '14':
                $searchSlots = [
                    13,14,22,23
                ];
                break;
            case '15':
                $searchSlots = [
                    15,28
                ];
                break;
            default:
                $searchSlots = [(int)$slots];
        }
        $query1 = $this->createQueryBuilder('a')
            ->andWhere('(a.name LIKE :word OR a.name_de LIKE :word OR a.id LIKE :word) AND a.inventorySlot IN ('.implode(',', $searchSlots).')')
            ->setParameter('word', '%' . addcslashes($query, '%_') . '%')
            ->orderBy('a.name', 'ASC')
            ->getQuery();
        return $query1
            ->getResult();
    }
}
