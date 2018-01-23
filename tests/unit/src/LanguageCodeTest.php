<?php

use G4\ValueObject\LanguageCode;
use G4\ValueObject\Exception\InvalidLanguageCodeException;

class LanguageCodeTest extends PHPUnit_Framework_TestCase
{

    public function testToString()
    {
        $this->assertEquals('fr_FR', (string)new LanguageCode('fr_FR'));
    }

    public function testExceptionInvalidCode()
    {
        $this->expectException(InvalidLanguageCodeException::class);
        new LanguageCode('laaaanguage');
    }
}