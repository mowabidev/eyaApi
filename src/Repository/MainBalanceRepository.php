<?php

namespace App\Repository;

use App\Entity\MainBalance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainBalance|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainBalance|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainBalance[]    findAll()
 * @method MainBalance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainBalanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainBalance::class);
    }

    // /**
    //  * @return MainBalance[] Returns an array of MainBalance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainBalance
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
