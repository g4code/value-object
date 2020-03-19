<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class MissingGenderOppositeException extends Exception
{
    public function __construct($value)
    {
        $message = sprintf('Opposite gender(s) for %s not found', $value);

        parent::__construct($message, ErrorCodes::MISSING_GENDER_OPPOSITE);
    }
}
