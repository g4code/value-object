<?php

use G4\ValueObject\Ip;


class IpTest extends \PHPUnit\Framework\TestCase
{

    public function testToString()
    {
        $this->assertEquals('1.1.1.1', (string)(new Ip('1.1.1.1')));
    }

    public function testExceptionInvalidIp()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidIpException::class);
        new Ip('carrot');
    }

    public function testExceptionNullIp()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidIpException::class);
        new Ip('');
    }

}