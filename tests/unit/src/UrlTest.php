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

    public function testgetQueryParams()
    {
        $url = new Url('http://subdomain.domain.com');
        $url->query(new Dictionary(['query1' => 'test1', 'query2' => 'test2']));
        $this->assertEquals(['query1' => 'test1', 'query2' => 'test2'], $url->getQueryParams());
    }

    public function testQueryWithSolrAllParameter()
    {
        $url = new Url('http://subdomain.domain.com');

        $this->assertEquals('http://subdomain.domain.com?q=*%3A*&', (string) $url->query(new Dictionary(['q' => '*:*'])));
    }

    public function testOverridePort()
    {
        $url = new Url('http://subdomain.domain.com:8080/path1/path2?query1=test1&query2=test2');

        $this->assertEquals('http://subdomain.domain.com:8880/path1/path2?query1=test1&query2=test2', (string) $url->port(new PortNumber(8880)));
    }

    public function testOverridePath()
    {
        $url = new Url('http://subdomain.domain.com:8080/path1/path2?query1=test1&query2=test2');

        $this->assertEquals('http://subdomain.domain.com:8080/new_path1/new_path2/new_path3?query1=test1&query2=test2', (string) $url->path('new_path1', 'new_path2', 'new_path3'));
    }

    public function testOverrideQuery()
    {
        $url = new Url('http://subdomain.domain.com:8080/path1/path2?query1=test1&query2=test2');

        $this->assertEquals('http://subdomain.domain.com:8080/path1/path2?new_query=test3', (string) $url->query(new Dictionary(['new_query' => 'test3'])));
    }

    public function testOverrideAllParameters()
    {
        $baseUrl = new Url('http://subdomain.domain.com:8080/path1/path2?query1=test1&query2=test2');
        
        $url = $baseUrl
                    ->port(new PortNumber('8081'))
                    ->path('new_path1', 'new_path2')
                    ->query(new Dictionary(['new_query1' => 'test1', 'new_query2' => 'test2', 'new_query3' => 'test3']));

        $this->assertEquals('http://subdomain.domain.com:8081/new_path1/new_path2?new_query1=test1&new_query2=test2&new_query3=test3', (string) $url);
    }
}
