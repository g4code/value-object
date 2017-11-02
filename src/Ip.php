<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidIpException;

class Ip implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * Ip constructor.
     * @param $value
     * @throws InvalidIpException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidIpException($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function isValid($value)
    {
        return filter_var($value, FILTER_VALIDATE_IP);
    }
}
