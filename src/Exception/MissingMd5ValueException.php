<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingMd5ValueException extends \Exception
{
    const ERROR_MESSAGE = 'Md5 value is missing.';

    /**
     * MissingEmailValueException constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        $message = sprintf(self::ERROR_MESSAGE, \var_export($value, true));
        $code = ErrorCodes::MISSING_MD5_VALUE;
        parent::__construct($message, $code);
    }
}
