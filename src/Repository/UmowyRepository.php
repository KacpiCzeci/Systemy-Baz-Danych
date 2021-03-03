<?php

namespace App\Repository;

use App\Entity\Umowy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Umowy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Umowy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Umowy[]    findAll()
 * @method Umowy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UmowyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Umowy::class);
    }

    public function deleteRozwiaz_umowy(string $id_umowy)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            call rozwiaz_umowe(:id_umowy)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_umowy' => $id_umowy]);
    }

    public function findByRegex(string $regex)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        select * from umowy where nr_umowy = :regex or
        rodzaj_umowy = :regex
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['regex' => $regex]);

        return $stmt->fetchAll();
    }

    // /**
    //  * @return Umowy[] Returns an array of Umowy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Umowy
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
