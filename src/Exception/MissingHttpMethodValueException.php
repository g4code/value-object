<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingHttpMethodValueException extends \Exception
{
    const ERROR_MESSAGE = 'Http method value is missing.';

    /**
     * MissingHttpMethodValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_HTTP_METHOD_VALUE);
    }
}
