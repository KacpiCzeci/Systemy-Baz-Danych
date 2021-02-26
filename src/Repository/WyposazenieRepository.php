<?php

namespace App\Repository;

use App\Entity\Wyposazenie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wyposazenie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wyposazenie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wyposazenie[]    findAll()
 * @method Wyposazenie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WyposazenieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wyposazenie::class);
    }

    // /**
    //  * @return Wyposazenie[] Returns an array of Wyposazenie objects
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
    public function findOneBySomeField($value): ?Wyposazenie
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
