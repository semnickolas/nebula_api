<?php


namespace App\Component;

use App\Entity\AstrologerService;
use App\Entity\Customer;
use App\Entity\Order;
use App\TransportObject\PaymentNotification;

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

    /**
     * @param Order $order
     * @param Customer $customer
     * @param AstrologerService $service
     * @return PaymentNotification
     */
    public function createPaymentNotification(Order $order, Customer $customer, AstrologerService $service) : PaymentNotification
    {
        return new PaymentNotification($order, $customer, $service);
    }
}