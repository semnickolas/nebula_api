<?php

namespace App\Procedure;

use App\TransportObject\Command\BuyService;
use App\Validation\SimpleObjectValidator;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Ufo\JsonRpcBundle\ApiMethod\Interfaces\IRpcService;

/**
 * Class OrderCommandProcedure
 * @package App\Procedure
 */
class OrderCommandProcedure implements IRpcService
{
    private SimpleObjectValidator $validator;

    private SerializerInterface $serializer;

    private MessageBusInterface $commandBus;

    /**
     * OrderCommandProcedure constructor.
     * @param SimpleObjectValidator $validator
     * @param SerializerInterface $serializer
     * @param MessageBusInterface $commandBus
     */
    public function __construct(
        SimpleObjectValidator $validator,
        SerializerInterface $serializer,
        MessageBusInterface $commandBus
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    /**
     * @param int $serviceId
     * @param string $buyerEmail
     * @param string $buyerName
     */
    public function buyService(int $serviceId, string $buyerEmail, string $buyerName) : void
    {
        $command = $this->serializer->denormalize(
            ['id' => $serviceId, 'email' => $buyerEmail, 'name' => $buyerName],
            BuyService::class
        );
        $this->validator->validate($command);

        $this->commandBus->dispatch($command);
    }
}