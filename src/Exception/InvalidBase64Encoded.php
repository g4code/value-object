<?php

namespace G4\ValueObject\Exception;


use G4\ValueObject\ErrorCodes;

class InvalidBase64Encoded extends \Exception
{
    const MESSAGE = '%s is not a valid base64 encoded value!';

    public function __construct($value)
    {
        parent::__construct(sprintf(self::MESSAGE, $value), ErrorCodes::INVALID_BASE64_ENCODED);
    }
}
