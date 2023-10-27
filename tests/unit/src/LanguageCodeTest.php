<?php

use G4\ValueObject\LanguageCode;
use G4\ValueObject\Exception\InvalidLanguageCodeException;

class LanguageCodeTest extends \PHPUnit\Framework\TestCase
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

    public function testEquals()
    {
        $languageCode = new LanguageCode('fr_FR');

        $this->assertTrue($languageCode->equals(new LanguageCode('fr_FR')));
        $this->assertFalse($languageCode->equals(new LanguageCode('de_DE')));
    }
}