<?php

use G4\ValueObject\DomainName;
use G4\ValueObject\StringLiteral;
use G4\ValueObject\Exception\InvalidDomainNameException;

class DomainNameTest extends \PHPUnit_Framework_TestCase
{


    public function testValidDomains()
    {
        $domainName = new DomainName('spanish.es');
        $this->assertEquals('spanish.es', (string) $domainName);

        $domainName = new DomainName('comdomain.com');
        $this->assertEquals('comdomain.com', (string) $domainName);

        $domainName = new DomainName('netdomain.net');
        $this->assertEquals('netdomain.net', (string) $domainName);

        $domainName = new DomainName('french.fr');
        $this->assertEquals('french.fr', (string) $domainName);

        $domainName = new DomainName('italian.it');
        $this->assertEquals('italian.it', (string) $domainName);

        $domainName = new DomainName('swiss.ch');
        $this->assertEquals('swiss.ch', (string) $domainName);

        $domainName = new DomainName('swedish.se');
        $this->assertEquals('swedish.se', (string) $domainName);

        $domainName = new DomainName('norwegian.no');
        $this->assertEquals('norwegian.no', (string) $domainName);
    }

    public function testInvalidDomain()
    {
        $this->expectException(InvalidDomainNameException::class);
        new DomainName('s---a%%%%%%aaa1.a.coco');
    }

    public function testEquals()
    {
        $domainNameOne = new DomainName('google.com');
        $domainNameTwo = new DomainName('google.com');
        $domainNameThree = new DomainName('google.de');

        $this->assertTrue($domainNameOne->equals($domainNameTwo));
        $this->assertFalse($domainNameTwo->equals($domainNameThree));
    }

    public function testAppend()
    {
        $domainName = new DomainName('google.com');
        $appended   = $domainName->append(new StringLiteral('int'), new StringLiteral('dev'));

        $this->assertInstanceOf(DomainName::class, $appended);
        $this->assertEquals('google.com.int.dev', (string) $appended);
    }

    public function testPrepend()
    {
        $domainName = new DomainName('google.com');
        $prepended  = $domainName->prepend(new StringLiteral('www'), new StringLiteral('beta'));

        $this->assertInstanceOf(DomainName::class, $prepended);
        $this->assertEquals('www.beta.google.com', (string) $prepended);
    }
}