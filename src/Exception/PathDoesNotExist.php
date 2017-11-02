<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class PathDoesNotExist extends \Exception
{

    const MESSAGE = 'Path does not exists: %s';

    public function __construct($path)
    {
        parent::__construct(sprintf(self::MESSAGE, $path), ErrorCodes::MISSING_DIRS);
    }
}
