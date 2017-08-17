<?php

use G4\ValueObject\StringLiteral;

class StringLiteralTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidString()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $this->assertEquals('tralala', (string) $aStringLiteral);

        $aStringLiteral = new StringLiteral(123.456);
        $this->assertEquals('123.456', (string) $aStringLiteral);

        $aStringLiteral = new StringLiteral(null);
        $this->assertEquals('', (string) $aStringLiteral);
    }

    public function testAppend()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->append(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('tralalaaaa', (string) $modifiedString);

        $modifiedStringWithDelimiter = $modifiedString->append(new StringLiteral('b'), new StringLiteral('-'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedStringWithDelimiter);
        $this->assertEquals('tralalaaaa-b', (string) $modifiedStringWithDelimiter);
    }

    public function testPrepend()
    {
        $aStringLiteral = new StringLiteral('tralala');
        $modifiedString = $aStringLiteral->prepend(new StringLiteral('aaa'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedString);
        $this->assertEquals('aaatralala', (string) $modifiedString);

        $modifiedStringWithDelimiter = $modifiedString->prepend(new StringLiteral('b'), new StringLiteral('-'));

        $this->assertInstanceOf(StringLiteral::class, $modifiedStringWithDelimiter);
        $this->assertEquals('b-aaatralala', (string) $modifiedStringWithDelimiter);
    }
}