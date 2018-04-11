<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidTimestampValueException extends \Exception
{
    const MESSAGE = 'A %s is not valid timestamp value.';

    /**
     * InvalidTimestampValueException constructor.
     * @param string $version
     */
    public function __construct($version)
    {
        parent::__construct(sprintf(self::MESSAGE, $version), ErrorCodes::INVALID_TIMESTAMP_VALUE);
    }
}
