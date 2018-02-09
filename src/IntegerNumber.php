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
     * @param $value
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        if ($value === true || \filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidIntegerNumberException($value);
        }
        $this->value = \intval($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }

    /**
     * @param IntegerNumber $value
     * @return bool
     */
    public function equals(IntegerNumber $value)
    {
        return $this->value === $value->getValue();
    }

    /*
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }
}
