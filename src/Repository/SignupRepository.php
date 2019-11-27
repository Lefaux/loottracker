<?php

namespace App\Repository;

use App\Entity\RaidEvent;
use App\Entity\Signup;
use App\Service\SignUpService;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method Signup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Signup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Signup[]    findAll()
 * @method Signup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SignupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Signup::class);
    }

    public function findSignUpsPerAccount(array $characters): array
    {
        $output = [];
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM signup WHERE player_name_id IN (' . implode(',', $characters)  . ')';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $item) {
                $output[$item['player_name_id']][$item['raid_event_id']] = $item['signed_up'];
            }
        } catch (DBALException $e) {
        }

        return $output;
    }

    /**
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function findSignUpsInRaidWeek(DateTime $start, DateTime $end): array
    {
        $qb = $this->createQueryBuilder('s');
        $query = $qb
            ->select('s')
            ->innerJoin('s.raidEvent', 'e')
            ->innerJoin('s.playerName', 'p')
            ->where('e.start > :start AND e.end < :end AND s.signedUp = 1')
            ->addOrderBy('p.spec', 'ASC')
            ->addOrderBy('p.class','ASC')
            ->addOrderBy('p.name','ASC')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery();
        return $query->getResult();
    }

    /**
     * @param RaidEvent $raidEvent
     * @return array
     */
    public function findByRaid(RaidEvent $raidEvent): array
    {
        $qb = $this->createQueryBuilder('s');
        $query = $qb
            ->select('s')
            ->innerJoin('s.raidEvent', 'e')
            ->innerJoin('s.playerName', 'p')
            ->where('e.id = :event')
            ->addOrderBy('p.spec', 'ASC')
            ->addOrderBy('p.class','ASC')
            ->addOrderBy('p.name','ASC')
            ->setParameter('event', $raidEvent->getId())
            ->getQuery();
        return $query->getResult();
    }

    public function checkIfCharIsSignedUpForAllEvents(array $characters): bool
    {
        $charList = [];
        foreach ($characters as $character) {
            $charList[] = $character->getId();
        }
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT *
                FROM raid_event e
                WHERE e.id NOT IN (SELECT s.raid_event_id FROM signup s WHERE s.player_name_id IN (' . implode(',', $charList)  . '))';
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach ($result as $item) {
                $deadline = SignUpService::findRaidSignUpEnd($item['start']);
                $foo= '';
                if ($deadline->getTimestamp() > time()) {
                    return false;
                } else {
                    $foo = '';
                }
            }
        } catch (DBALException $e) {
        }

        return true;
    }
}
