<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingEmailValueException extends \Exception
{
    const ERROR_MESSAGE = 'Email value is missing.';

    /**
     * MissingEmailValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, \var_export($value, true));
        $code = ErrorCodes::MISSING_EMAIL_VALUE;
        parent::__construct($message, $code);
    }
}
