<?php

namespace App\Repository;

use App\Entity\Budynki;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Budynki|null find($id, $lockMode = null, $lockVersion = null)
 * @method Budynki|null findOneBy(array $criteria, array $orderBy = null)
 * @method Budynki[]    findAll()
 * @method Budynki[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BudynkiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Budynki::class);
    }

    public function findByRegex(string $regex)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select * from budynki where adres = :regex or 
            typ = :regex
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['regex' => $regex]);

        return $stmt->fetchAll();
    }

    // /**
    //  * @return Budynki[] Returns an array of Budynki objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Budynki
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
