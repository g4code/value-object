<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidGaCodeException extends \Exception
{
    const MESSAGE = '%s is not a valid google analytics value.';

    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_GA_CODE
        );
    }
}
