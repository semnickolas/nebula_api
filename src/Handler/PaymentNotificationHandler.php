<?php


namespace App\Handler;

use App\TransportObject\PaymentNotification;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class PaymentNotificationHandler
 * @package App\Handler
 */
class PaymentNotificationHandler implements MessageHandlerInterface
{
//    private Am
    public function __invoke(PaymentNotification $paymentNotification)
    {

    }

}