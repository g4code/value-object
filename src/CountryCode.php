<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidCountryCodeException;

class CountryCode
{

    //TODO: Drasko - add more country codes!
    const CODES = [
        'AT' => 'Austria',
        'CA' => 'Canada',
        'CH' => 'Switzerland',
        'DE' => 'Germany',
        'DK' => 'Denmark',
        'ES' => 'Spain',
        'FI' => 'Finland',
        'FR' => 'France',
        'GB' => 'United Kingdom',
        'IT' => 'Italy',
        'NO' => 'Norway',
        'RU' => 'Russia',
        'SE' => 'Sweden',
        'US' => 'United States',
    ];

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
        return self::CODES[$this->value];
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return array_key_exists($value, self::CODES);
    }
}