<?php

namespace G4\ValueObject\Exception;

class InvalidIpException extends \Exception
{

    const ERROR_CODE = 608;

    const ERROR_MESSAGE = 'Ip is not valid: %s';

    /**
     * InvalidIpException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(
            sprintf(self::ERROR_MESSAGE, $value),
            self::ERROR_CODE
        );
    }
}