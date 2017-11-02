<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidUrlException;

class Url implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * Url constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL) === false) {
            $this->value = $value;
        } else {
            throw new InvalidUrlException($value);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
