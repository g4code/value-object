<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidPortNumberException;

class PortNumber extends IntegerNumber
{
    private $value;

    public function __construct($value)
    {
        parent::__construct($value);

        if ($value < 1 || $value > 65535) {
            throw new InvalidPortNumberException($value);
        }

        $this->value = $value;
    }
}
