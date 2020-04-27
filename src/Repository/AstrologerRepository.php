<?php

namespace App\Repository;

use App\Entity\Astrologer;
use App\TransportObject\Query\GetAstrologer;
use App\TransportObject\Query\GetAstrologers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Astrologer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astrologer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astrologer[]    findAll()
 * @method Astrologer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstrologerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Astrologer::class);
    }

    /**
     * @param GetAstrologer $query
     * 
     * @return Astrologer
     */
    public function getAstrologer(GetAstrologer $query) : Astrologer
    {
        return $this->find($query->getId());
    }
    
    /**
     * @param GetAstrologers $query
     * @return array
     */
    public function getAstrologers(GetAstrologers $query) : array
    {
        $filter = $query->getFilter();
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'ASC')
            ->setFirstResult($query->getOffset())
            ->setMaxResults($query->getLimit());

        if (!empty($filter)) {
            $literal = $qb->expr()->literal("%$filter%");
            $qb->add('where', $qb->expr()->orX(
                $qb->expr()->like('a.firstName', $literal),
                $qb->expr()->like('a.lastName', $literal),
                $qb->expr()->like('a.email', $literal),
            ));
        }

        return $qb->getQuery()->getResult();
    }
}
