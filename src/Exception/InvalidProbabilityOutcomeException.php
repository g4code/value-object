<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class InvalidProbabilityOutcomeException extends Exception
{
    const ERROR_MESSAGE = 'Failed to get outcome from possibilities %s with probability %s';

    /**
     * InvalidProbabilityOutcomeException constructor.
     * @param $probability
     * @param $possibilities
     */
    public function __construct($probability, $possibilities)
    {
        parent::__construct(
            sprintf(self::ERROR_MESSAGE, $possibilities, $probability),
            ErrorCodes::INVALID_PROBABILITY_OUTCOME
        );
    }
}
