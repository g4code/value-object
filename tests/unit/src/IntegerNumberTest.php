<?php

use G4\ValueObject\IntegerNumber;
use G4\ValueObject\Exception\InvalidIntegerNumberException;

class IntegerNumberTest extends \PHPUnit_Framework_TestCase
{

    public function testValidInteger()
    {
        $integerNumber = new IntegerNumber(12);
        $this->assertEquals(12, $integerNumber->getValue());

        $integerNumber = new IntegerNumber("12");
        $this->assertEquals(12, $integerNumber->getValue());
    }

    public function testFloat()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(12.5);
    }

    public function testNull()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(null);
    }

    public function testFalse()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(false);
    }

    public function testTrue()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(true);
    }

    public function testSpace()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber(' ');
    }

    public function testEmptyString()
    {
        $this->expectException(InvalidIntegerNumberException::class);
        new IntegerNumber('');
    }
}