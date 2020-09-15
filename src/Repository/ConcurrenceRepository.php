<?php

namespace App\Repository;

use App\Entity\Concurrence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Concurrence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concurrence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concurrence[]    findAll()
 * @method Concurrence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcurrenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concurrence::class);
    }

    // /**
    //  * @return Concurrence[] Returns an array of Concurrence objects
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
    public function findOneBySomeField($value): ?Concurrence
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
