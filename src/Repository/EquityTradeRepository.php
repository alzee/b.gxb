<?php

namespace App\Repository;

use App\Entity\EquityTrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquityTrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquityTrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquityTrade[]    findAll()
 * @method EquityTrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquityTradeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquityTrade::class);
    }

    // /**
    //  * @return EquityTrade[] Returns an array of EquityTrade objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquityTrade
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
