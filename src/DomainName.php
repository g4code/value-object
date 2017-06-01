<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidDomainNameException;

class DomainName implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * DomainName constructor.
     * @param $value
     * @throws InvalidDomainNameException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidDomainNameException($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function isValid($value)
    {
        return \is_string($value)
            && preg_match('/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/uxis', $value) === 1;
    }
}