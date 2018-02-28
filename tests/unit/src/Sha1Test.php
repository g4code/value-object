<?php

use G4\ValueObject\Sha1;
use G4\ValueObject\Exception\InvalidSha1Exception;
use G4\ValueObject\Exception\MissingSha1ValueException;

class Sha1Test extends PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $value1 = 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3';
        $value2 = sha1('test');

        $this->assertEquals($value1, (string) (new Sha1($value1)));
        $this->assertEquals($value2, (string) (new Sha1($value2)));
    }

    public function testInvalidSha1ValueException()
    {
        $this->expectException(InvalidSha1Exception::class);

        $value = 'a9461c4c0873d391e987982fbd3';
        new Sha1($value);
    }

    public function testEmptySh1Value()
    {
        $this->expectException(MissingSha1ValueException::class);
        new Sha1('');
    }

    public function testNullSh1Value()
    {
        $this->expectException(MissingSha1ValueException::class);
        new Sha1(null);
    }

    public function testSpaceSha1Value()
    {
        $this->expectException(InvalidSha1Exception::class);
        (new Sha1(' '));
    }

    public function testEqualsSha1Value()
    {
        $sha1Value = new Sha1('a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');
        $this->assertTrue($sha1Value->equals(new Sha1('a94a8fe5ccb19ba61c4c0873d391e987982fbbd3')));
        $this->assertFalse($sha1Value->equals(new Sha1('a94a8fe5ccb19ba61c4c0873d391e987982fbbd4')));
    }

    public function testCalculateSha1()
    {
        $sha1Value       = sha1('test');
        $calculatedValue = Sha1::calculateSha1('test');

        $this->assertInstanceOf(Sha1::class, $calculatedValue);
        $this->assertEquals($sha1Value, (string) $calculatedValue);
    }
}