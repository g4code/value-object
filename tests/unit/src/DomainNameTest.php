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

    public function testGetTopLevelDomainName()
    {
        $topLevel = (new DomainName('www.google.com'))->getTopLevelDomainName();

        $this->assertInstanceOf(StringLiteral::class, $topLevel);
        $this->assertEquals('com', (string) $topLevel);
    }

    public function testGetFirstLevelDomainName()
    {
        $firstLevel = (new DomainName('www.google.com'))->getFirstLevelDomainName();

        $this->assertInstanceOf(DomainName::class, $firstLevel);
        $this->assertEquals('google.com', (string) $firstLevel);

        $this->assertEquals('google.com', (string) (new DomainName('a1.www.google.com'))->getFirstLevelDomainName());
        $this->assertEquals('google.com', (string) (new DomainName('google.com'))->getFirstLevelDomainName());
    }

    public function testDiff()
    {
        $diff = (new DomainName('www.google.com'))->diff(new DomainName('google.com'));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('www', (string) $diff);

        $this->assertEquals('www.beta', (string) (new DomainName('www.beta.google.com'))->diff(new DomainName('google.com')));
        $this->assertEquals('', (string) (new DomainName('google.com'))->diff(new DomainName('google.com')));
    }
}