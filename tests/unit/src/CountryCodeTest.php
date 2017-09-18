<?php

use G4\ValueObject\CountryCode;
use G4\ValueObject\Exception\InvalidCountryCodeException;

class CountryCodeTest extends PHPUnit_Framework_TestCase
{


    public function testValidCountryCode()
    {
        $countryCode = new CountryCode('ES');
        $this->assertEquals('ES', (string)$countryCode);
        $this->assertEquals('Spain', $countryCode->getName());
    }

    public function testInvalidCountryCode()
    {
        $this->expectException(InvalidCountryCodeException::class);
        new CountryCode('TI');
    }
}