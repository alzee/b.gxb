<?php

namespace App\Repository;

use App\Entity\EquityFee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquityFee|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquityFee|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquityFee[]    findAll()
 * @method EquityFee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquityFeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquityFee::class);
    }

    // /**
    //  * @return EquityFee[] Returns an array of EquityFee objects
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
    public function findOneBySomeField($value): ?EquityFee
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
