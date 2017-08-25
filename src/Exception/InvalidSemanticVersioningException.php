<?php

namespace G4\ValueObject\Exception;

use G4\ValueObject\ErrorCodes;

class InvalidSemanticVersioningException extends \Exception
{
    const MESSAGE = 'Version is not valid: %s';

    public function __construct($version)
    {
        parent::__construct(sprintf(self::MESSAGE, $version), ErrorCodes::INVALID_SEMANTIV_VERSION);
    }
}