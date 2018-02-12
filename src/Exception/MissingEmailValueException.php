<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingEmailValueException extends \Exception
{
    const ERROR_MESSAGE = 'Email value is missing.';

    /**
     * MissingEmailValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_EMAIL_VALUE);
    }
}
