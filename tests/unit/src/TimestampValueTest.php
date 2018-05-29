<?php

use G4\ValueObject\TimestampValue;
use G4\ValueObject\Exception\MissingTimestampValueException;
use G4\ValueObject\Exception\InvalidTimestampValueException;

class TimestampValueTest extends \PHPUnit_Framework_TestCase
{
    public function testMissingValueException()
    {
        $this->expectException(MissingTimestampValueException::class);
        new TimestampValue('');
    }

    public function testInvalidValueFloatException()
    {
        $this->expectException(InvalidTimestampValueException::class);
        new TimestampValue('1.0');
    }

    public function testInvalidValueHexaNumberException()
    {
        $this->expectException(InvalidTimestampValueException::class);
        new TimestampValue('0xFF');
    }

    public function testValidValues()
    {
        $now          = time();
        $timestampInt = new TimestampValue($now);
        $this->assertEquals($now, (string) $timestampInt);
        $this->assertEquals($now, $timestampInt->getValue());

        $timestampString = new TimestampValue('1523441442');
        $this->assertEquals('1523441442', (string) $timestampString);
    }

    public function testGetFormatted()
    {
        $timestampString = new TimestampValue('1523441442');
        $this->assertEquals('2018-04-11', $timestampString->getFormatted());
        $this->assertEquals('April 11 / 12:10', $timestampString->getFormatted('F j / g:i'));
    }
}
