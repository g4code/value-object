<?php

namespace G4\ValueObject\Exception;

use Exception;

class InvalidStringLiteralException extends \Exception
{
    const ERROR_STRING_LITERAL = 601;

    public function __construct($value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be a STRING.', $value);
        $code = self::ERROR_STRING_LITERAL;
        parent::__construct($message, $code);
    }
}