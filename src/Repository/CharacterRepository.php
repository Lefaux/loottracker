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

    public function findByHead(array $filters): array
    {
        $query = $this->createQueryBuilder('c');
        $query->where('c.hidden = 0');
        // Filter for Character Class
        foreach ($filters['head'] as $index => $filter) {
            $preparedValueName = 'param_Head_' . $index;
            switch ($index) {
                case 1:
                    $constraints[] = 'c.HeadOny IN (:' . $preparedValueName .')';
                    $query->setParameter($preparedValueName, array_keys($filters['mode']));
                    break;
                case 2:
                    $constraints[] = 'c.HeadNef IN (:' . $preparedValueName .')';
                    $query->setParameter($preparedValueName, array_keys($filters['mode']));
                    break;
                case 3:
                    $constraints[] = 'c.HeadLash IN (:' . $preparedValueName .')';
                    $query->setParameter($preparedValueName, array_keys($filters['mode']));
                    break;
                case 4:
                    $constraints[] = 'c.headHakkar IN (:' . $preparedValueName .')';
                    $query->setParameter($preparedValueName, array_keys($filters['mode']));
                    break;
                case 5:
                    $constraints[] = 'c.headCthun IN (:' . $preparedValueName .')';
                    $query->setParameter($preparedValueName, array_keys($filters['mode']));
                    break;
            }
        }
        // Apply constraints if available
        if (!empty($constraints)) {
            $query->andWhere(implode(' OR ', $constraints));
        }
        return $query->orderBy('c.class')
            ->addOrderBy('c.spec', 'DESC')
            ->addOrderBy('c.name')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByClass(array $filters): array
    {
        $constraints[] = 'c.twink IN (:twink)';
        $includeTwinks[] = 0;
        $query = $this->createQueryBuilder('c');
        $query->where('c.hidden = 0');
        // Filter for Character Class
        if (array_key_exists('class', $filters)) {
            $constraints[] = 'c.class IN (:classIds)';
            $query->setParameter('classIds', array_keys($filters['class']));
        }
        // Filter for Character Spec
        if (array_key_exists('spec', $filters)) {
            $constraints[] = 'c.spec IN (:specIds)';
            $query->setParameter('specIds', array_keys($filters['spec']));
        }
        // Filter for Character Rank
        if (array_key_exists('rank', $filters)) {
            $ranksToShow = [];
            foreach ($filters['rank'] as $ranks => $_) {
                if ($ranks === 'twink') {
                    // special twink handling
                    $includeTwinks[] = 1;
                } else {
                    $singleRanks = explode(',', $ranks);
                    foreach ($singleRanks as $singleRank) {
                        $ranksToShow[] = (int)$singleRank;
                    }
                }
            }
            $constraints[] = 'c.rank IN (:rankIds)';
            $query->setParameter('rankIds', $ranksToShow);
        }
        $query->setParameter('twink', $includeTwinks);
        // Apply constraints if available
        if (!empty($constraints)) {
            $query->andWhere(implode(' AND ', $constraints));
        }
        return $query->orderBy('c.class')
            ->addOrderBy('c.spec', 'DESC')
            ->addOrderBy('c.name')
            ->getQuery()
            ->getResult()
            ;
    }
}
