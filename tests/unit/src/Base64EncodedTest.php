<?php

use G4\ValueObject\Base64Encoded;
use G4\ValueObject\Exception\InvalidBase64Encoded;

class Base64EncodedTest extends PHPUnit_Framework_TestCase
{
    public function testBase64Encoded()
    {
        $this->assertEquals(
            'aGVsbG8gd29ybGQ=',
            $this->base64EncodedFactory('aGVsbG8gd29ybGQ=')
        );
    }

    public function testInvalidBase64Encoded()
    {
        $this->expectException(InvalidBase64Encoded::class);
        $this->base64EncodedFactory('');
    }

    private function base64EncodedFactory($encodedBytes)
    {
        return new Base64Encoded($encodedBytes);
    }
}