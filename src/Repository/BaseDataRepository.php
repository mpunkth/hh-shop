<?php

namespace App\Repository;

use App\Entity\BaseData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BaseData|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseData|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseData[]    findAll()
 * @method BaseData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaseData::class);
    }

    // /**
    //  * @return BaseData[] Returns an array of BaseData objects
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
    public function findOneBySomeField($value): ?BaseData
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
