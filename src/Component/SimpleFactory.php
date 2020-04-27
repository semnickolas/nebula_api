<?php


namespace App\Component;

use App\Entity\AstrologerService;
use App\Entity\Customer;
use App\Entity\Order;

/**
 * Class SimpleFactory
 * @package App\Component
 */
class SimpleFactory
{
    /**
     * @param Customer $customer
     * @param AstrologerService $service
     * @return Order
     */
    public function createOrder(Customer $customer, AstrologerService $service) : Order
    {
        return (new Order())->setCustomer($customer)
            ->setService($service)
            ->setStatus(Order::STATUS_NEW)
            ->setCost($service->getCost());
    }
}