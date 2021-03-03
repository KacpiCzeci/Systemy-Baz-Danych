<?php

namespace App\Repository;

use App\Entity\Wyszukiwanie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wyszukiwanie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wyszukiwanie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wyszukiwanie[]    findAll()
 * @method Wyszukiwanie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WyszukiwanieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wyszukiwanie::class);
    }

    // /**
    //  * @return Wyszukiwanie[] Returns an array of Wyszukiwanie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wyszukiwanie
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
