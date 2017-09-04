<?php

use G4\ValueObject\BooleanValue;
use G4\ValueObject\Exception\InvalidBooleanException;

class BooleanTest extends \PHPUnit_Framework_TestCase
{
    public function testValidBooleans()
    {
        $this->assertTrue((new BooleanValue(true))->getValue());
        $this->assertFalse((new BooleanValue(false))->getValue());
    }

    public function testIntegerException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue(1))->getValue();
    }

    public function testStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue('somestring'))->getValue();
    }

    public function testStringBooleanException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue('true'))->getValue();
    }

    public function testArrayException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue([]));
    }

    public function testStringArrayException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue('[]'));
    }

    public function testNegativeIntegerException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue(-1));
    }

    public function testZeroException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue(0));
    }

    public function testEmptyStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue(' '));
    }

    public function testNullStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue('null'));
    }

    public function testNullValueException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new BooleanValue(null));
    }
}