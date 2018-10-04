<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidGenderKeyException extends \Exception
{

    public function __construct($value)
    {
        $message = sprintf('Gender key %s is invalid', \var_export($value, true));
        parent::__construct($message, ErrorCodes::INVALID_GENDER_KEY);
    }
}
