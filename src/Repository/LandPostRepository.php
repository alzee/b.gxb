<?php

namespace App\Repository;

use App\Entity\LandPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LandPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method LandPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method LandPost[]    findAll()
 * @method LandPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LandPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LandPost::class);
    }

    // /**
    //  * @return LandPost[] Returns an array of LandPost objects
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
    public function findOneBySomeField($value): ?LandPost
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
