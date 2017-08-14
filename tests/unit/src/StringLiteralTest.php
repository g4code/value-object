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

    public function testAppend()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->append(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('tralalaaaa', (string) $modifiedString);
    }

    public function testPrepend()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->prepend(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('aaatralala', (string) $modifiedString);
    }
}