<?php

namespace G4\ValueObject\Exception;

class InvalidDomainNameException extends \Exception
{

    const ERROR_CODE = 607;

    const ERROR_MESSAGE = 'Domain name is not valid: %s';

    /**
     * InvalidDomainNameException constructor.
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