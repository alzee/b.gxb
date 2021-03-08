<?php

namespace App\Repository;

use App\Entity\Gxb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gxb|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gxb|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gxb[]    findAll()
 * @method Gxb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GxbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gxb::class);
    }

    // /**
    //  * @return Gxb[] Returns an array of Gxb objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gxb
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
