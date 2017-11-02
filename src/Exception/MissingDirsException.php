<?php

namespace G4\ValueObject\Exception;

use Exception;
use G4\ValueObject\ErrorCodes;

class MissingDirsException extends Exception
{

    const MESSAGE = 'No directories to construct absolute path';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, ErrorCodes::MISSING_DIRS);
    }
}
