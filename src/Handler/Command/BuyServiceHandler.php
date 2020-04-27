<?php

namespace App\Handler\Command;

use App\Component\PaymentProcessor;
use App\TransportObject\PaymentNotification;
use App\Repository\AstrologerServiceRepository;
use App\Repository\CustomerRepository;
use App\TransportObject\Command\BuyService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class BuyServiceHandler
 * @package App\Handler\Command
 */
class BuyServiceHandler
{
    private AstrologerServiceRepository $serviceRepository;

    private CustomerRepository $customerRepository;

    private PaymentProcessor $paymentProcessor;

    private MessageBusInterface $messageBus;

    /**
     * BuyServiceHandler constructor.
     * @param AstrologerServiceRepository $serviceRepository
     * @param CustomerRepository $customerRepository
     * @param PaymentProcessor $paymentProcessor
     * @param MessageBusInterface $messageBus
     */
    public function __construct(
        AstrologerServiceRepository $serviceRepository,
        CustomerRepository $customerRepository,
        PaymentProcessor $paymentProcessor,
        MessageBusInterface $messageBus
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->customerRepository = $customerRepository;
        $this->paymentProcessor = $paymentProcessor;
        $this->messageBus = $messageBus;
    }

    /**
     * @param BuyService $command
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(BuyService $command) : void
    {
        $service = $this->serviceRepository->getService($command->getId());
        $customer = $this->customerRepository->getCustomer($command->getEmail(), $command->getName());

        $order = $this->paymentProcessor->applyPayment($customer, $service);
        $this->messageBus->dispatch(PaymentNotification::create($order, $customer, $service));
    }
}