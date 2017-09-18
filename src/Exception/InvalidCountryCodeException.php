<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidCountryCodeException extends \Exception
{
    const MESSAGE = '%s is not a valid country code!';

    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_COUNTRY_CODE
        );
    }
}
