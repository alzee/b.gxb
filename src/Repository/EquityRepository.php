<?php

namespace App\Repository;

use App\Entity\Equity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equity[]    findAll()
 * @method Equity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equity::class);
    }

    // /**
    //  * @return Equity[] Returns an array of Equity objects
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
    public function findOneBySomeField($value): ?Equity
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
