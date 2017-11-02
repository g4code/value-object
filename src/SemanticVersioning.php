<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidSemanticVersioningException;

class SemanticVersioning
{
    /**
     * @var string
     */
    private $value;

    /**
     * SemanticVersioning constructor.
     * @param $value
     * @throws InvalidSemanticVersioningException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidSemanticVersioningException($value);
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
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return \is_string($value) && preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}$/', $value) === 1;
    }
}
