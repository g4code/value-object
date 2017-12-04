<?php

use G4\ValueObject\Url;
use G4\ValueObject\Exception\InvalidUrlException;
use G4\ValueObject\PortNumber;
use G4\ValueObject\Dictionary;

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

    public function testPath()
    {
        $url = new Url('http://subdomain.domain.com');

        $this->assertEquals('http://subdomain.domain.com/path1/path2', (string) $url->path('path1', 'path2'));
    }

    public function testPort()
    {
        $url = new Url('http://subdomain.domain.com');

        $this->assertEquals('http://subdomain.domain.com:8080', (string) $url->port(new PortNumber('8080')));
    }

    public function testQuery()
    {
        $url = new Url('http://subdomain.domain.com');

        $this->assertEquals('http://subdomain.domain.com?query1=test1&query2=test2', (string) $url->query(new Dictionary(['query1' => 'test1', 'query2' => 'test2'])));
    }
}
