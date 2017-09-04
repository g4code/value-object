<?php

namespace G4\ValueObject\Exception;

class InvalidBooleanException extends \Exception
{
    const ERROR_BOOLEAN = 612;

    public function __construct($value)
    {
        $message = sprintf('Argument %s is invalid. The value must be a boolean', \var_export($value, true));
        $code = self::ERROR_BOOLEAN;
        parent::__construct($message, $code);
    }
}