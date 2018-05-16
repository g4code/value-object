<?php

namespace G4\ValueObject;

use G4\ValueObject\Constants\Country;
use G4\ValueObject\Exception\InvalidCountryCodeException;

class CountryCode
{

    /**
     * @var string
     */
    private $value;

    /**
     * CountryCode constructor.
     * @param $value
     * @throws InvalidCountryCodeException
     */
    public function __construct($value)
    {
        if (! $this->isValid($value)) {
            throw new InvalidCountryCodeException($value);
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

    public function getName()
    {
        return Country::CODES[$this->value];
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return array_key_exists($value, Country::CODES);
    }
}
