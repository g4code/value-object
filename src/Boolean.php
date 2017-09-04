<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidBooleanException;

class Boolean
{
    /**
     * @var bool
     */
    private $value;

    /**
     * Boolean constructor.
     * @param $value
     * @throws InvalidBooleanException
     */
    public function __construct($value)
    {
        if(!is_bool($value)) {
            throw new InvalidBooleanException($value);
        }
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getValue()
    {
        return $this->value;
    }
}