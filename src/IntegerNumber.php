<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidIntegerNumberException;

class IntegerNumber implements NumberInterface
{
    /*
     * @var integer
     */
    private $value;

    /**
     * IntegerNumber constructor.
     * @param $value integer
     * @throws \Exception
     */
    public function __construct($value)
    {
        if(!\is_int($value)) {
            throw new InvalidIntegerNumberException($value);
        }

        $this->value = $value;
    }

    /*
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }
}