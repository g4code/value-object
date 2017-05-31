<?php

use G4\ValueObject\Url;
use G4\ValueObject\Exception\InvalidUrlException;

class UrlTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidUrl()
    {
        $this->assertEquals('https://subdomain.domain.com/path1/path2', (string) new Url('https://subdomain.domain.com/path1/path2'));
        $this->assertEquals('http://subdomain.domain.com/path1/path2?query=test+1', (string) new Url('http://subdomain.domain.com/path1/path2?query=test+1'));
        $this->assertEquals('http://subdomain.domain.com', (string) new Url('http://subdomain.domain.com'));
    }

    public function testWithInvalidUrl()
    {
        $this->expectException(InvalidUrlException::class);
        new Url('www.example.com');
    }
}