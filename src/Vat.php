<?php

namespace G4\ValueObject;
use G4\ValueObject\Exception\MissingVatException;

class Vat
{

    private $value;

    private $vatMap = [
        'AT' => 20,
        'CH' => 8,
        'DK' => 25,
        'ES' => 21,
        'FI' => 24,
        'FR' => 20,
        'IT' => 22,
        'NO' => 25,
        'SE' => 25,
    ];

    public function __construct(CountryCode $countryCode)
    {
        if(!array_key_exists((string)$countryCode, $this->vatMap)){
            throw new MissingVatException((string)$countryCode);
        }
        $this->value = $this->vatMap[(string)$countryCode];
    }

    public function get()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value . '%';
    }

}