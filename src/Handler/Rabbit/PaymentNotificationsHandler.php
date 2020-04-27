<?php

namespace App\Handler\Rabbit;

use Exception;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use App\TransportObject\PaymentNotification;
use App\Component\SpreadSheetsClientFactory;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class PaymentNotificationHandler
 * @package App\Handler\Rabbit
 */
class PaymentNotificationsHandler implements MessageHandlerInterface
{
    private const RANGE = 'A2:H';

    private string $sheetId;

    private SpreadSheetsClientFactory $factory;

    private OutputInterface $output;

    /**
     * PaymentNotificationsHandler constructor.
     *
     * @param SpreadSheetsClientFactory $factory
     * @param string $sheetId
     */
    public function __construct(SpreadSheetsClientFactory $factory, string $sheetId)
    {
        $this->factory = $factory;
        $this->sheetId = $sheetId;
        $this->output = new ConsoleOutput();
    }

    /**
     * @param PaymentNotification $paymentNotification
     *
     * @throws Exception
     */
    public function __invoke(PaymentNotification $paymentNotification)
    {
        $orderId = $paymentNotification->getOrderId();
        $this->output->writeln("Process order #$orderId");

        $client = $this->factory->createSheetClient();
        $body = $this->createBody($paymentNotification);
        $this->handleRaw($client, $body);

        $this->output->writeln("Process order #$orderId has been sent to spreadsheet");
    }

    /**
     * @param Google_Service_Sheets $client
     * @param Google_Service_Sheets_ValueRange $body
     */
    private function handleRaw(Google_Service_Sheets $client, Google_Service_Sheets_ValueRange $body) : void
    {
        $client->spreadsheets_values->append(
            $this->sheetId,
            self::RANGE,
            $body,
            ["valueInputOption" => "RAW", "insertDataOption" => "INSERT_ROWS"]
        );
    }

    /**
     * @param PaymentNotification $paymentNotification
     *
     * @return Google_Service_Sheets_ValueRange
     */
    private function createBody(PaymentNotification $paymentNotification) : Google_Service_Sheets_ValueRange
    {
        $body = $this->factory->createSheetsValueRange();
        $body->setRange(self::RANGE);
        $raw = [
            $paymentNotification->getOrderId(),
            $paymentNotification->getOrderCost(),
            $paymentNotification->getServiceTitle(),
            $paymentNotification->getCustomerName(),
            $paymentNotification->getCustomerEmail(),
            $paymentNotification->getAstrologerId(),
            $paymentNotification->getAstrologerEmail(),
            $paymentNotification->getPaidDate()->format('Y-m-d H:i:s'),
        ];
        $body->setValues([$raw]);

        return $body;
    }
}