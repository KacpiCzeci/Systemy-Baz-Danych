<?php

namespace App\Repository;

use App\Entity\Osoby;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Osoby|null find($id, $lockMode = null, $lockVersion = null)
 * @method Osoby|null findOneBy(array $criteria, array $orderBy = null)
 * @method Osoby[]    findAll()
 * @method Osoby[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OsobyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Osoby::class);
    }

    // /**
    //  * @return Osoby[] Returns an array of Osoby objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Osoby
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
