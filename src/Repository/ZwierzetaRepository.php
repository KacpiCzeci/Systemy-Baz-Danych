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

    public function findByRegex(string $regex)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select z.id as zid, u.id as uid, z.gatunek, u.nr_umowy from zwierzeta z join umowy u on z.id_umowy = u.id where z.gatunek = :regex or 
            u.nr_umowy = :regex
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['regex' => $regex]);

        return $stmt->fetchAll();
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
