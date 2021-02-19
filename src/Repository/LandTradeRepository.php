<?php

namespace App\Repository;

use App\Entity\LandTrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LandTrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method LandTrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method LandTrade[]    findAll()
 * @method LandTrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandTradeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LandTrade::class);
    }

    // /**
    //  * @return LandTrade[] Returns an array of LandTrade objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LandTrade
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
