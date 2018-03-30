<?php

use G4\ValueObject\Md5;
use G4\ValueObject\Exception\InvalidMd5Exception;
use G4\ValueObject\Exception\MissingMd5ValueException;

class Md5Test extends PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $value = '7e4ef92d1472fa1a2d41b2d3c1d2b77a';

        $this->assertEquals($value, (string) (new Md5($value)));
    }

    public function testInvalidValue()
    {
        $this->expectException(InvalidMd5Exception::class);

        new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a3');
    }

    public function testCalculateMd5()
    {
        $md5 = Md5::calculateMd5('tralala');

        $this->assertInstanceOf(Md5::class, $md5);
    }

    public function testEmptyMd5Value()
    {
        $this->expectException(MissingMd5ValueException::class);
        (new Md5(''));
    }

    public function testNullMd5Value()
    {
        $this->expectException(MissingMd5ValueException::class);
        (new Md5(null));
    }

    public function testSpaceMd5Value()
    {
        $this->expectException(InvalidMd5Exception::class);
        (new Md5(' '));
    }

    public function testEqualsMd5Value()
    {
        $md5Value = new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a');
        $this->assertTrue($md5Value->equals(new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77a')));
        $this->assertFalse($md5Value->equals(new Md5('7e4ef92d1472fa1a2d41b2d3c1d2b77b')));
    }
}
