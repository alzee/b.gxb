<?php

namespace App\Repository;

use App\Entity\NodeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NodeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NodeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NodeType[]    findAll()
 * @method NodeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NodeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NodeType::class);
    }

    // /**
    //  * @return NodeType[] Returns an array of NodeType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NodeType
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
