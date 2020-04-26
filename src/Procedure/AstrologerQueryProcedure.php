<?php

namespace App\Procedure;

use App\TransportObject\Query\GetAstrologer;
use App\TransportObject\Query\GetAstrologers;
use App\Validation\SimpleObjectValidator;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

/**
 * Class AstrologerQueryProcedure
 * @package App\Procedure
 */
class AstrologerQueryProcedure implements IRpcService
{
    use HandleTrait;

    private SimpleObjectValidator $validator;

    private SerializerInterface $serializer;

    /**
     * AstrologerQueryProcedure constructor.
     * @param SimpleObjectValidator $validator
     * @param SerializerInterface $serializer
     * @param MessageBusInterface $queryBus
     */
    public function __construct(
        SimpleObjectValidator $validator,
        SerializerInterface $serializer,
        MessageBusInterface $queryBus
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->messageBus = $queryBus;
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @param string $filter
     *
     * @return array
     */
    public function getAstrologers(int $page = 0, int $pageSize = 100, ?string $filter = null) : array
    {
        $query = $this->serializer->denormalize(
            ['page' => $page, 'pageSize' => $pageSize, 'filter' => $filter],
            GetAstrologers::class
        );
        $this->validator->validate($query);

        return $this->handle($query);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAstrologer(int $id) : array
    {
        $query = $this->serializer->denormalize(['id' => $id], GetAstrologer::class);
        $this->validator->validate($query);

        return $this->handle($query);
    }
}