<?php

namespace G4\ValueObject\Exception;

class InvalidLanguageCodeException extends \Exception
{
    const ERROR_UUID = 616;

    const ERROR_MESSAGE = 'Language code is invalid.';

    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, \var_export($value, true));
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}
