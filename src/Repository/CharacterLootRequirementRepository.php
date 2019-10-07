<?php

namespace App\Repository;

use App\Entity\CharacterLootRequirement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method CharacterLootRequirement|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterLootRequirement|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterLootRequirement[]    findAll()
 * @method CharacterLootRequirement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterLootRequirementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterLootRequirement::class);
    }

    public function getBisList(): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    bis.item_id,
       bis.priority,
       bis.has_item,
       bis.slot,
    c.name,
       c.class,
       c.spec
FROM
    character_loot_requirement bis
    INNER JOIN characters c on bis.player_character_id = c.id
ORDER BY c.class, c.spec
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $index => $item) {
                $output[$item['class']][$item['name']][$item['slot']][$item['priority']] = $item;
            }
        } catch (DBALException $e) {
        }

        return $output;
    }
}
