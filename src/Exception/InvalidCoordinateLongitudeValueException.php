<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class InvalidCoordinateLongitudeValueException extends Exception
{
    const ERROR_MESSAGE = 'Coordinate longitude is not valid: %s';

    /**
     * InvalidCoordinateLongitudeValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $value), ErrorCodes::INVALID_LONGITUDE_VALUE);
    }
}
