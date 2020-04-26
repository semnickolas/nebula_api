<?php


namespace App\Exception;

use LogicException;

/**
 * Class AstrologerServiceNotFound
 * @package App\Exception
 */
class AstrologerServiceNotFound extends LogicException
{
    /**
     * @var int
     */
    protected $code = 404;

    /**
     * @var string
     */
    protected $message = 'Selected service not found';
}