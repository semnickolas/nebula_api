<?php

namespace App\Repository;

use App\Entity\AstrologerService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AstrologerService|null find($id, $lockMode = null, $lockVersion = null)
 * @method AstrologerService|null findOneBy(array $criteria, array $orderBy = null)
 * @method AstrologerService[]    findAll()
 * @method AstrologerService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstrologerServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AstrologerService::class);
    }

    // /**
    //  * @return AstrologerService[] Returns an array of AstrologerService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AstrologerService
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
