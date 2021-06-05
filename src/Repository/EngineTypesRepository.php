<?php

namespace App\Repository;

use App\Entity\EngineTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EngineTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method EngineTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method EngineTypes[]    findAll()
 * @method EngineTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngineTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EngineTypes::class);
    }

    // /**
    //  * @return EngineTypes[] Returns an array of EngineTypes objects
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
    public function findOneBySomeField($value): ?EngineTypes
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
