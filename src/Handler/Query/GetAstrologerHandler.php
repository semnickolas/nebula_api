<?php

namespace App\Handler\Query;

use App\Component\AstrologerDataFormatter;
use App\Repository\AstrologerRepository;
use App\TransportObject\Query\GetAstrologer;

/**
 * Class GetAstrologerHandler
 * @package App\Handler\Query
 */
class GetAstrologerHandler
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
     * @param GetAstrologer $query
     * @return array
     */
    public function __invoke(GetAstrologer $query) : array
    {
        $astrologer = $this->repository->getAstrologer($query);

        return $this->formatter->format($astrologer);
    }
}