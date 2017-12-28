<?php

namespace G4\ValueObject\Exception;

use Exception;

class MissingVatException extends Exception
{
    const ERROR_CODE      = 615;
    const ERROR_MESSAGE   = 'Vat not set for country code: %s';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, $value);
        $code = self::ERROR_CODE;
        parent::__construct($message, $code);
    }
}
