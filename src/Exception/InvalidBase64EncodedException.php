<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidBase64EncodedException extends \Exception
{
    const MESSAGE = '%s is not a valid base64 encoded value!';

    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::MESSAGE, \var_export($value, true)),
            ErrorCodes::INVALID_BASE64_ENCODED
        );
    }
}
