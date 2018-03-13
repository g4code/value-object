<?php

use G4\ValueObject\LanguageCode;
use G4\ValueObject\Exception\InvalidLanguageCodeException;

class LanguageCodeTest extends PHPUnit_Framework_TestCase
{

    public function testToString()
    {
        $this->assertEquals('fr_FR', (string)new LanguageCode('fr_FR'));
        $this->assertEquals('ru_RU', (string)new LanguageCode('ru_RU'));
        $this->assertEquals('sr_RS@latin', (string)new LanguageCode('sr_RS@latin'));
    }

    public function testExceptionInvalidCode()
    {
        $this->expectException(InvalidLanguageCodeException::class);
        new LanguageCode('laaaanguage');
    }
}