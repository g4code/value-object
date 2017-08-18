<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidEnvironment extends \Exception
{
    const MESSAGE = 'Environment is not valid: %s';

    public function __construct($environment)
    {
        parent::__construct(sprintf(self::MESSAGE, $environment), ErrorCodes::INVALID_ENVIRONMENT);
    }
}