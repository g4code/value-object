<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidUuidException extends \Exception
{
    const ERROR_UUID = 602;

    public function __construct($value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be a UUID STRING.', $value);
        $code = self::ERROR_UUID;
        parent::__construct($message, $code);
    }
}
