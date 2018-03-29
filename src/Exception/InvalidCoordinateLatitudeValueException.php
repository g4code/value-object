<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class InvalidCoordinateLatitudeValueException extends Exception
{
    const ERROR_MESSAGE = 'Coordinate latitude is not valid: %s';

    /**
     * InvalidCoordinateValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $value), ErrorCodes::INVALID_LATITUDE_VALUE);
    }
}
