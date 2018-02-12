<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingMd5ValueException extends \Exception
{
    const ERROR_MESSAGE = 'Md5 value is missing.';

    /**
     * MissingMd5ValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_MD5_VALUE);
    }
}
