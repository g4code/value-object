<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class MissingCoordinateValueException extends Exception
{
    const ERROR_MESSAGE = 'Coordinate value is missing.';

    /**
     * MissingCoordinateValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_COORDINATE_VALUE);
    }
}
