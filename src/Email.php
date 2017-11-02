<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidEmailException;

class Email
{

    /**
     * @var string
     */
    private $value;

    /**
     * Email constructor.
     * @param string $value
     * @throws InvalidEmailException
     */
    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
