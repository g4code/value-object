<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingTimestampValueException extends \Exception
{
    const ERROR_MESSAGE = 'Timestamp value is missing.';

    /**
     * MissingTimestampValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_TIMESTAMP_VALUE);
    }
}
