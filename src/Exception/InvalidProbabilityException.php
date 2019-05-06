<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class InvalidProbabilityException extends Exception
{
    const ERROR_MESSAGE = 'Probability is not valid: %s';

    /**
     * InvalidProbabilityException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $value), ErrorCodes::INVALID_PROBABILITY);
    }
}
