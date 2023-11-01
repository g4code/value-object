<?php

use G4\ValueObject\HttpMethod;
use G4\ValueObject\Exception\InvalidHttpMethodException;
use G4\ValueObject\Exception\MissingHttpMethodValueException;

class HttpMethodTest extends \PHPUnit\Framework\TestCase
{
    public function testToString()
    {
        $value = 'INDEX';

        $this->assertEquals($value, (string) (new HttpMethod($value)));
    }

    public function testInvalidValue()
    {
        $this->expectException(InvalidHttpMethodException::class);
        new HttpMethod('INVALID');
    }

    public function testEmptyValue()
    {
        $this->expectException(MissingHttpMethodValueException::class);
        (new HttpMethod(''));
    }

    public function testNullValue()
    {
        $this->expectException(MissingHttpMethodValueException::class);
        (new HttpMethod(null));
    }

    public function testSpaceValue()
    {
        $this->expectException(InvalidHttpMethodException::class);
        (new HttpMethod(' '));
    }

    public function testEqualsValue()
    {
        $httpMethodValue = new HttpMethod('GET');
        $this->assertTrue($httpMethodValue->equals(new HttpMethod('GET')));
        $this->assertFalse($httpMethodValue->equals(new HttpMethod('INDEX')));
    }
}
