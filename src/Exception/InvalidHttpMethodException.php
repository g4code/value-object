<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidHttpMethodException extends \Exception
{
    const ERROR_MESSAGE = 'Value is not valid http method: %s';

    /**
     * InvalidHttpMethodException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $value), ErrorCodes::INVALID_HTTP_METHOD_VALUE);
    }
}
