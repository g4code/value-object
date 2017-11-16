<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidGaCodeException;

class GACode
{
    /**
     * @var string
     */
    private $value;

    /**
     * GACode constructor.
     * @param $value
     * @throws InvalidGaCodeException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidGaCodeException($value);
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
        return preg_match('/^ua-\d{4,9}-\d{1,4}$/i', $value) === 1;
    }
}
