<?php

use G4\ValueObject\StringLiteral;


class StringLiteralTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidString()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $this->assertEquals('tralala', (string) $aStringLiteral);
    }

    public function testWithInvalidString()
    {
        $this->expectException('\G4\ValueObject\Exception\InvalidStringLiteralException');
        new StringLiteral(123.567);
    }
}