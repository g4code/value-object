<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidDictionaryException extends \Exception
{
    const ERROR_UUID = 603;

    public function __construct($value)
    {
        $message = sprintf('Argument %s is invalid.', \var_export($value, true));
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}