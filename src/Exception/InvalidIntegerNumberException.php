<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidIntegerNumberException extends \Exception
{
    const ERROR_INTEGER_NUMBER = 606;
    const ERROR_MESSAGE        = 'Argument "%s" is invalid. Argument must be an INTEGER.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, $value);
        $code = self::ERROR_INTEGER_NUMBER;
        parent::__construct($message, $code);
    }
}
