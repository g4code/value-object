<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidAssetsUrlValueException extends \Exception
{
    const MESSAGE = '%s is not a valid assets url value!';

    /**
     * InvalidAssetsUrlValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_ASSETS_URL_VALUE
        );
    }
}
