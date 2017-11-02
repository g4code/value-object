<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class InvalidMd5Exception extends Exception
{

    const MESSAGE = 'String is not md5: %s';

    public function __construct($value)
    {
        parent::__construct(sprintf(self::MESSAGE, $value), ErrorCodes::INVALID_MD5);
    }
}
