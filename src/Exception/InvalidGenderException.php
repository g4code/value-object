<?php

namespace G4\ValueObject\Exception;

class InvalidGenderException extends \Exception
{
    const ERROR_UUID = 609;

    public function __construct($value)
    {
        $message = sprintf('Gender %s is invalid', \var_export($value, true));
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}
