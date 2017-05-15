<?php

use G4\ValueObject\StringLiteral;
use G4\ValueObject\Exception\InvalidStringLiteralException;

class StringLiteralTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidString()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $this->assertEquals('tralala', (string) $aStringLiteral);
    }

    public function testWithInvalidString()
    {
        $this->expectException(InvalidStringLiteralException::class);
        new StringLiteral(123.567);
    }
}