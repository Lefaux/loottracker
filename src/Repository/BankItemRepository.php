<?php

namespace App\Repository;

use App\Entity\BankItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

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

    public function listBankSlots(): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    bank.id,
    item.class_id,
    item.sub_class_id,
    item.item_level,
    item.required_level,
    item.quality,
    item.id as itemId,
    cat.name as categoryName,
    subcat.name as subCategoryName,
    bank.amount
FROM bank_item bank
    INNER JOIN item item on item.id = bank.item_id
    INNER JOIN category cat on cat.id = item.class_id
    INNER JOIN sub_category subcat ON subcat.id = item.sub_class_id AND subcat.parent_class_id = item.class_id
ORDER BY
    cat.sorting,
    subcat.sorting,
    item.item_level,
    item.required_level
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $index => $item) {
                $output[$item['categoryName']][$item['subCategoryName']][$item['itemId']] = $item;
            }
        } catch (DBALException $e) {
            $foo = '';
        }

        return $output;
    }
}
