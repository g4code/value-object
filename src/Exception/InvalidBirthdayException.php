<?php

namespace G4\ValueObject\Exception;

class InvalidBirthdayException extends \Exception
{
    const ERROR_UUID = 610;

    public function __construct($value)
    {
        $message = sprintf('Year %s is invalid', \var_export($value, true));
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}
