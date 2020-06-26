<?php

namespace App\Repository;

use App\Entity\Chant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chant[]    findAll()
 * @method Chant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chant::class);
    }

    // /**
    //  * @return Chant[] Returns an array of Chant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
