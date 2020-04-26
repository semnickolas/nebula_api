<?php

namespace App\Validation;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 * Class SimpleObjectValidator
 * @package App\Validation
 */
class SimpleObjectValidator
{
    const FIRST_ERROR = 0;
    private const ERROR_CODE = 403;

    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    /**
     * SimpleObjectValidator constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param object $object
     *
     * @throws ValidatorException
     */
    public function validate(object $object) : void
    {
        $errors = $this->validator->validate($object);
        if ($errors->count() > 0) {
            throw new ValidatorException($errors->get(self::FIRST_ERROR)->getMessage(), self::ERROR_CODE);
        }
    }
}