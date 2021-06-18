<?php

namespace App\Repository;

use App\Entity\CarBodys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarBodys|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarBodys|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarBodys[]    findAll()
 * @method CarBodys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarBodysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarBodys::class);
    }

    // /**
    //  * @return CarBodys[] Returns an array of CarBodys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarBodys
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
