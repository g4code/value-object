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

        $domainName = new DomainName(' www.swedish.se');
        $this->assertEquals('www.swedish.se', (string) $domainName);
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

        $this->assertEquals('foo-bar-baz.com', (string) (new DomainName('a1.www.foo-bar-baz.com'))->getFirstLevelDomainName());
        $this->assertEquals('foo-bar-baz.com', (string) (new DomainName('foo-bar-baz.com'))->getFirstLevelDomainName());

        $this->assertEquals('bla-bla.org', (string) (new DomainName('d1.www.bla-bla.org'))->getFirstLevelDomainName());
        $this->assertEquals('bla-bla.org', (string) (new DomainName('bla-bla.org'))->getFirstLevelDomainName());

        $this->assertEquals('domain.co.uk', (string) (new DomainName('a1.www.domain.co.uk'))->getFirstLevelDomainName());
        $this->assertEquals('domain.co.uk', (string) (new DomainName('domain.co.uk'))->getFirstLevelDomainName());

        $this->assertEquals('domain.de', (string) (new DomainName('a1.www.domain.de'))->getFirstLevelDomainName());
        $this->assertEquals('domain.de', (string) (new DomainName('domain.de'))->getFirstLevelDomainName());

        $this->assertEquals('domain.com.au', (string) (new DomainName('a1.b1.www.domain.com.au'))->getFirstLevelDomainName());
        $this->assertEquals('domain.com.au', (string) (new DomainName('domain.com.au'))->getFirstLevelDomainName());

        $this->assertEquals('domain.online', (string) (new DomainName('subdomain.domain.online'))->getFirstLevelDomainName());
        $this->assertEquals('domain.online', (string) (new DomainName('domain.online'))->getFirstLevelDomainName());

        $this->assertEquals('domain.fi', (string) (new DomainName('subdomain.domain.fi'))->getFirstLevelDomainName());
        $this->assertEquals('domain.fi', (string) (new DomainName('domain.fi'))->getFirstLevelDomainName());
    }

    public function testDiff()
    {
        $diff = (new DomainName('www.google.com'))->diff(new DomainName('google.com'));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('www', (string) $diff);

        $this->assertEquals('www.beta', (string) (new DomainName('www.beta.google.com'))->diff(new DomainName('google.com')));
        $this->assertEquals('', (string) (new DomainName('google.com'))->diff(new DomainName('google.com')));
    }

    public function testTruncate()
    {
        $domain = (new DomainName('www.google.com'))->truncate(new StringLiteral('www'));

        $this->assertInstanceOf(DomainName::class, $domain);
        $this->assertEquals('google.com', (string) $domain);

        $domain = (new DomainName('t1.www.google.com.ch'))->truncate(
            new StringLiteral('t1'),
            new StringLiteral('ch'), new StringLiteral('www'));
        $this->assertEquals('google.com', (string) $domain);
    }
}