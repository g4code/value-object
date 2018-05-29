<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidDeviceValueException extends \Exception
{
    const MESSAGE = '%s is not a valid device';

    /**
     * InvalidDeviceValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_DEVICE_VALUE
        );
    }
}
