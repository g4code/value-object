<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidSha1Exception extends \Exception
{
    const ERROR_MESSAGE = 'String is not sha1: %s';

    /**
     * InvalidSha1Exception constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $value), ErrorCodes::INVALID_SHA1_VALUE);
    }
}
