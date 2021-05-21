<?php

namespace App\Repository;

use App\Entity\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bid|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bid|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bid[]    findAll()
 * @method Bid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bid::class);
    }

    public function getBids($position): ?Bid
    {
        $today = (new \DateTime('today'))->format('c');
        $yesterday = (new \DateTime('yesterday'))->format('c');
        return $this->createQueryBuilder('b')
            ->setParameter('today', $today)
            ->setParameter('yesterday', $yesterday)
            ->setParameter('position', $position)
            ->andWhere('b.position = :position')
            ->andWhere('b.date < :today')
            ->andWhere('b.date > :yesterday')
            ->orderBy('b.date', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
    }

    public function getTodayBid($position): ?Bid
    {
        $today = (new \DateTime('today'))->format('c');
        return $this->createQueryBuilder('b')
            ->setParameter('today', $today)
            ->setParameter('position', $position)
            ->andWhere('b.position = :position')
            ->andWhere('b.date > :today')
            ->orderBy('b.date', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Bid[] Returns an array of Bid objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bid
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
