<?php

namespace App\Repository;

use App\Entity\Zwierzeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zwierzeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zwierzeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zwierzeta[]    findAll()
 * @method Zwierzeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZwierzetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zwierzeta::class);
    }

    // /**
    //  * @return Zwierzeta[] Returns an array of Zwierzeta objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zwierzeta
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
