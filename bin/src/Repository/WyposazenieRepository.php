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

    public function findByRegex(string $regex)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            select nazwa, w.id as wid, o.mieszkanie as omieszkanie, adres, nr_mieszkania from wyposazenie w join obiekty_najmu o on w.mieszkanie=o.mieszkanie where w.nazwa = :regex or 
            o.adres = :regex or 
            o.nr_mieszkania = :regex
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['regex' => $regex]);

        return $stmt->fetchAll();
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
