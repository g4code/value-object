<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidCurrencyException extends Exception
{
    const ERROR_PORT_NUMBER    = 614;
    const ERROR_MESSAGE        = 'Argument "%s" is invalid.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, $value);
        $code = self::ERROR_PORT_NUMBER;
        parent::__construct($message, $code);
    }
}
