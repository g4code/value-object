<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class MissingSha1ValueException extends \Exception
{
    const ERROR_MESSAGE = 'Sha1 value is missing.';

    /**
     * MissingSh1ValueException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::ERROR_MESSAGE, ErrorCodes::MISSING_SHA1_VALUE);
    }
}
