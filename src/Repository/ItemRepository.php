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
        $sql = $query1->getSQL();
        $foo = '';
        return $query1
            ->getResult();
    }
}
