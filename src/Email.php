<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidEmailException;
use G4\ValueObject\Exception\MissingEmailValueException;

class Email
{
    /**
     * @var string
     */
    private $value;

    /**
     * Email constructor.
     * @param string $value
     * @throws MissingEmailValueException
     * @throws InvalidEmailException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingEmailValueException($value);
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($value);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param Email $value
     * @return bool
     */
    public function equals(Email $value)
    {
        return $this->value === $value->__toString();
    }

    /**
     * @return string
     */
    public function getWithoutPlusAlias()
    {
        $this->value = preg_replace("/\+\S+(?=@\w+)/", "", $this->value);
        return $this->value;
    }
}
