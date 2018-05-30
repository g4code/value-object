<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidLocationException extends \Exception
{
    const ERROR_MESSAGE = 'Location is invalid.';

    public function __construct($value)
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::INVALID_LOCATION_VALUE);
    }
}
