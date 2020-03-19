<?php

namespace App\Repository;

use App\Entity\BankItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BankItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankItem[]    findAll()
 * @method BankItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankItem::class);
    }

    public function removeData(): void
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->delete()->from(BankItem::class, 'bank_item')->getQuery()->execute();
    }
}
