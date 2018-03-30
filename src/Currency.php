<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidCurrencyException;

class Currency
{
    private $value;

    private $currencyMap = [
        'EUR' => [
            'title' => 'Euro',
            'symbol' => '€'
        ],
        'CHF' => [
            'title' => 'Swiss Franc',
            'symbol' => null
        ],
        'USD' => [
            'title' => 'US Dollar',
            'symbol' => '$'
        ],
        'DKK' => [
            'title' => 'Danish krone',
            'symbol' => 'kr'
        ],
        'NOK' => [
            'title' => 'Norwegian krone',
            'symbol' => 'kr'
        ],
        'SEK' => [
            'title' => 'Swedish krona',
            'symbol' => 'kr'
        ],
    ];

    public function __construct($value)
    {
        if (!array_key_exists($value, $this->currencyMap)) {
            throw new InvalidCurrencyException($value);
        }
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getTitle()
    {
        return $this->currencyMap[$this->value]['title'];
    }

    public function getSymbol()
    {
        return $this->currencyMap[$this->value]['symbol'];
    }
}
