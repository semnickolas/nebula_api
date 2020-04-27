<?php

namespace App\TransportObject;

use App\Entity\AstrologerService;
use App\Entity\Customer;
use App\Entity\Order;
use DateTimeInterface;

/**
 * Class PaymentNotification
 * @package App\TransportObject
 */
class PaymentNotification
{
    private string $customerEmail;

    private string $customerName;

    private int $astrologerId;

    private string $astrologerEmail;

    private string $serviceTitle;

    private int $orderId;

    private float $orderCost;

    private DateTimeInterface $paidDate;

    /**
     * PaymentNotification constructor.
     * @param string $customerEmail
     * @param string $customerName
     * @param int $astrologerId
     * @param string $astrologerEmail
     * @param string $serviceTitle
     * @param int $orderId
     * @param float $orderCost
     * @param DateTimeInterface $paidDate
     */
    public function __construct(
        string $customerEmail,
        string $customerName,
        int $astrologerId,
        string $astrologerEmail,
        string $serviceTitle,
        int $orderId,
        float $orderCost,
        DateTimeInterface $paidDate
    ) {
        $this->customerEmail = $customerEmail;
        $this->customerName = $customerName;
        $this->astrologerId = $astrologerId;
        $this->astrologerEmail = $astrologerEmail;
        $this->serviceTitle = $serviceTitle;
        $this->orderId = $orderId;
        $this->orderCost = $orderCost;
        $this->paidDate = $paidDate;
    }

    /**
     * @param Order $order
     * @param Customer $customer
     * @param AstrologerService $service
     * @return static
     */
    public static function create(Order $order, Customer $customer, AstrologerService $service) : self
    {
        return new self(
            $customer->getEmail(),
            $customer->getName(),
            $service->getAstrologer()->getId(),
            $service->getAstrologer()->getEmail(),
            $service->getService()->getTitle(),
            $order->getId(),
            $order->getCost(),
            $order->getPaidAt()
        );
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @return int
     */
    public function getAstrologerId(): int
    {
        return $this->astrologerId;
    }

    /**
     * @return string
     */
    public function getAstrologerEmail(): string
    {
        return $this->astrologerEmail;
    }

    /**
     * @return string
     */
    public function getServiceTitle(): string
    {
        return $this->serviceTitle;
    }

    /**
     * @return float
     */
    public function getOrderCost(): float
    {
        return $this->orderCost;
    }

    /**
     * @return DateTimeInterface
     */
    public function getPaidDate(): DateTimeInterface
    {
        return $this->paidDate;
    }

    /**
     * @return int
     */
    public function getOrderId() : int
    {
        return $this->orderId;
    }
}