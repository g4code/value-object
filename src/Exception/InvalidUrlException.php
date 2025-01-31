<?php

namespace G4\ValueObject\Exception;

class InvalidUrlException extends \Exception
{
    const ERROR_CODE = 605;

    const ERROR_MESSAGE = 'Url %s is invalid.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, \var_export($value, true));
        $code = self::ERROR_CODE;
        parent::__construct($message, $code);
    }
}
