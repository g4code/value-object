<?php

use G4\ValueObject\Md5;
use G4\ValueObject\Exception\InvalidMd5Exception;

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

}
