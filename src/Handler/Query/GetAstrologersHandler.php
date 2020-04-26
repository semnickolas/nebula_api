<?php

namespace App\Handler\Query;

use App\Repository\AstrologerRepository;
use App\TransportObject\Query\GetAstrologers;

/**
 * Class GetAstrologersHandler
 * @package App\Handler\Query
 */
class GetAstrologersHandler
{
    private AstrologerRepository $repository;

    /**
     * GetAstrologersHandler constructor.
     * @param AstrologerRepository $repository
     */
    public function __construct(AstrologerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GetAstrologers $query
     * @return array
     */
    public function __invoke(GetAstrologers $query) : array
    {
        return $this->repository->getAstrologers($query);
    }
}