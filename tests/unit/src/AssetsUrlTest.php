<?php

use G4\ValueObject\AssetsUrl;
use G4\ValueObject\Exception\InvalidAssetsUrlValueException;

class AssetsUrlTest extends PHPUnit_Framework_TestCase
{
    public function testValidUrl()
    {
        $url = new AssetsUrl("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $this->assertEquals("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $url);
        $this->assertEquals("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());

        $newUrl = $url->prepend();
        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $newUrl);
        $this->assertEquals("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());

        $this->assertInstanceOf(AssetsUrl::class, $newUrl);
        $this->assertNotSame($url, $newUrl);
    }

    public function testWithHttps()
    {
        $url = new AssetsUrl("https://domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $this->assertEquals("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $url);
        $this->assertEquals("https://domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());

        $newUrl = $url->prepend();
        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $newUrl);
        $this->assertEquals("https://domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());

        $this->assertInstanceOf(AssetsUrl::class, $newUrl);
        $this->assertNotSame($url, $newUrl);
    }

    public function testWithHttp()
    {
        $url = new AssetsUrl("http://domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $this->assertEquals("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $url);

        $newUrl = $url->prepend();
        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $newUrl);
        $this->assertEquals("http://domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());

        $this->assertInstanceOf(AssetsUrl::class, $newUrl);
        $this->assertNotSame($url, $newUrl);
    }

    public function testWithSlashes()
    {
        $url = new AssetsUrl("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $url);
        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", $url->getValue());
    }

    public function testEquals()
    {
        $url     = new AssetsUrl("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $testUrl = new AssetsUrl("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");

        $this->assertTrue($url->equals($testUrl));

        $url     = new AssetsUrl("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $testUrl = new AssetsUrl("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");

        $this->assertFalse($url->equals($testUrl));
    }

    public function testPrepend()
    {
        $url    = new AssetsUrl("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $newUrl = $url->prepend();

        $this->assertEquals("//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $newUrl);

        $url    = new AssetsUrl("domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442");
        $newUrl = $url->prepend('test//');

        $this->assertEquals("test//domain.local/img/drv/first/second/b556-4fcd-ac27-21037aaef898.cea14sa3_drv1.jpg?1442", (string) $newUrl);
    }

    public function testNull()
    {
        $this->expectException(InvalidAssetsUrlValueException::class);
        new AssetsUrl(null);
    }

    public function testEmptyString()
    {
        $this->expectException(InvalidAssetsUrlValueException::class);
        new AssetsUrl('');
    }

    public function testNumber()
    {
        $this->expectException(InvalidAssetsUrlValueException::class);
        new AssetsUrl(2);
    }
}
