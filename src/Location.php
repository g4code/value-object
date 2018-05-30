<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidLocationException;

class Location extends StringLiteral
{

    public function __construct($value)
    {
        if (! filter_var($value, FILTER_VALIDATE_URL) &&
           ! preg_match('/^[\w\/]/', $value)) {
            throw new InvalidLocationException('Path invalid.');
        }

        parent::__construct($value);
    }

    public function addQuery(Dictionary $values)
    {
        $valuesArray = $values->getAll();

        return (string) $this . '?' . http_build_query($valuesArray);
    }
}
