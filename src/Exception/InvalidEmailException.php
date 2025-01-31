<?php

namespace G4\ValueObject\Exception;

class InvalidEmailException extends \Exception
{
    const ERROR_UUID = 604;

    const ERROR_MESSAGE = 'Email %s is invalid.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, \var_export($value, true));
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}
