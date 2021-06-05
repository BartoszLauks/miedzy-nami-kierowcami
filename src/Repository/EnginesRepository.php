<?php

namespace App\Repository;

use App\Entity\Engines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Engines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Engines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Engines[]    findAll()
 * @method Engines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnginesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Engines::class);
    }

    // /**
    //  * @return Engines[] Returns an array of Engines objects
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
    public function findOneBySomeField($value): ?Engines
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
