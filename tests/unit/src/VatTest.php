<?php

use G4\ValueObject\Vat;
use G4\ValueObject\Exception\MissingVatException;
use G4\ValueObject\CountryCode;

class VatTest extends \PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $this->assertEquals(22, (new Vat(new CountryCode('IT')))->get());
        $this->assertEquals(20, (new Vat(new CountryCode('FR')))->get());
    }

    public function testToString()
    {
        $this->assertEquals('22%', (string)new Vat(new CountryCode('IT')));
        $this->assertEquals('20%', (string)new Vat(new CountryCode('FR')));
    }

    public function testException()
    {
        $this->expectException(MissingVatException::class);
        $this->expectExceptionMessage('Vat not set for country code: GB');
        new Vat(new CountryCode('GB'));
    }
}