<?php

namespace App\Handler\Query;

use App\Repository\AstrologerRepository;
use App\Component\AstrologerDataFormatter;
use App\TransportObject\Query\GetAstrologers;

/**
 * Class GetAstrologersHandler
 * @package App\Handler\Query
 */
class GetAstrologersHandler
{
    private AstrologerRepository $repository;

    private AstrologerDataFormatter $formatter;

    /**
     * GetAstrologersHandler constructor.
     * @param AstrologerRepository $repository
     * @param AstrologerDataFormatter $formatter
     */
    public function __construct(AstrologerRepository $repository, AstrologerDataFormatter $formatter)
    {
        $this->repository = $repository;
        $this->formatter = $formatter;
    }

    /**
     * @param GetAstrologers $query
     * @return array
     */
    public function __invoke(GetAstrologers $query) : array
    {
        $astrologers = $this->repository->getAstrologers($query);

        return $this->formatter->formatAstrologers($astrologers);
    }
}