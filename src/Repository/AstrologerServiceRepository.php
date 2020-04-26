<?php

namespace App\Repository;

use App\Entity\AstrologerService;
use App\Exception\AstrologerServiceNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
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

    /**
     * @param int $id
     * @return AstrologerService
     */
    public function getService(int $id) : AstrologerService
    {
        $service = $this->find($id);
        if ($service === null) {
            throw new AstrologerServiceNotFound();
        }

        return $service;
    }
}
