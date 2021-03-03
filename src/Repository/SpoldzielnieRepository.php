<?php

namespace App\Repository;

use App\Entity\Spoldzielnie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Spoldzielnie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Spoldzielnie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Spoldzielnie[]    findAll()
 * @method Spoldzielnie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpoldzielnieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Spoldzielnie::class);
    }

    public function findByRegex(string $regex)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select * from spoldzielnie where nazwa = :regex or 
            adres = :regex
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['regex' => $regex]);

        return $stmt->fetchAll();
    }

    // /**
    //  * @return Spoldzielnie[] Returns an array of Spoldzielnie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Spoldzielnie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
