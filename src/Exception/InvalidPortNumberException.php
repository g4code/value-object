<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidPortNumberException extends Exception
{
    const ERROR_PORT_NUMBER = 613;
    const ERROR_MESSAGE        = 'Argument "%s" is invalid. Argument must be a PORT NUMBER.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, $value);
        $code = self::ERROR_PORT_NUMBER;
        parent::__construct($message, $code);
    }
}
