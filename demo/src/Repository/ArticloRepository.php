<?php

namespace App\Repository;

use App\Entity\Articlo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Articlo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articlo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articlo[]    findAll()
 * @method Articlo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articlo::class);
    }

    // /**
    //  * @return Articlo[] Returns an array of Articlo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Articlo
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
