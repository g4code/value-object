<?php

use G4\ValueObject\Boolean;
use G4\ValueObject\Exception\InvalidBooleanException;

class BooleanTest extends \PHPUnit_Framework_TestCase
{
    public function testValidBooleans()
    {
        $this->assertTrue((new Boolean(true))->getValue());
        $this->assertFalse((new Boolean(false))->getValue());
    }

    public function testIntegerException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean(1))->getValue();
    }

    public function testStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean('somestring'))->getValue();
    }

    public function testStringBooleanException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean('true'))->getValue();
    }

    public function testArrayException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean([]));
    }

    public function testStringArrayException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean('[]'));
    }

    public function testNegativeIntegerException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean(-1));
    }

    public function testZeroException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean(0));
    }

    public function testEmptyStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean(' '));
    }

    public function testNullStringException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean('null'));
    }

    public function testNullValueException()
    {
        $this->expectException(InvalidBooleanException::class);
        (new Boolean(null));
    }
}