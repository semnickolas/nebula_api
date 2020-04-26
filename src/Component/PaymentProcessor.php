<?php


namespace App\Component;

use App\Entity\AstrologerService;
use App\Entity\Customer;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class PaymentProcessor
 * @package App\Component
 */
class PaymentProcessor
{
    private SimpleFactory $factory;

    private DateFactory $dateFactory;

    private OrderRepository $orderRepository;

    /**
     * PaymentProcessor constructor.
     * @param SimpleFactory $factory
     * @param DateFactory $dateFactory
     * @param OrderRepository $orderRepository
     */
    public function __construct(SimpleFactory $factory, DateFactory $dateFactory, OrderRepository $orderRepository)
    {
        $this->factory = $factory;
        $this->dateFactory = $dateFactory;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Customer $customer
     * @param AstrologerService $service
     * @return Order
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function applyPayment(Customer $customer, AstrologerService $service) : Order
    {
        $order = $this->factory->createOrder($customer, $service);
        //TODO : release any payment logic
        $order->setStatus(Order::STATUS_PAID)->setPaidAt($this->dateFactory->createDateTime());
        $this->orderRepository->save($order);

        return $order;
    }
}