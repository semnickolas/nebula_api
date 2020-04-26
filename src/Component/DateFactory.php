<?php

namespace App\Component;

use DateTime;
use DateTimeImmutable;
use Exception;

/**
 * Class DateFactory
 * @package App\Component
 */
class DateFactory
{
    /**
     * @param string $date
     * @return DateTimeImmutable
     * @throws Exception
     */
    public function createDateTimeImmutable(string $date = 'now') : DateTimeImmutable
    {
        return new DateTimeImmutable($date);
    }
    /**
     * @param string $date
     * @return DateTime
     * @throws Exception
     */
    public function createDateTime(string $date = 'now') : DateTime
    {
        return new DateTime($date);
    }
}