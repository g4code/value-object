<?php

namespace G4\ValueObject\Exception;

class InvalidUuidHexException extends \InvalidArgumentException
{
    public function __construct($value)
    {
        $message = sprintf('Argument "%s" is invalid. Argument must be a Uuid Hex string.', $value);
        parent::__construct($message, 400);
    }
}
