<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findRecipeCategories()
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
SELECT
    count(i.id) as amount, sc.name, sc.id
FROM
    recipe r
INNER JOIN item i on r.recipe_id = i.id
INNER JOIN sub_category sc on i.sub_class_id = sc.id
GROUP BY sc.id
            ';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $output = $stmt->fetchAll();
        } catch (DBALException $e) {
        }

        return $output;
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findByCategory(int $category)
    {
        $output = [];
        $result = $this->createQueryBuilder('r')
            ->join('r.recipe', 'i')
            ->andWhere('i.subClass = :val')
            ->setParameter('val', $category)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
        /** @var Recipe $recipeRelation */
        foreach ($result as $recipeRelation) {
            $item = $recipeRelation->getRecipe();
            if ($item) {
                $output[$item->getId()]['recipe'] = $item;
                $output[$item->getId()]['players'][] = $recipeRelation->getPlayer();
            }
        }
        return $output;
    }

    /*
    public function findOneBySomeField($value): ?Recipe
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
