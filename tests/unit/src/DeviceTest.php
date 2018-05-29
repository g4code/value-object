<?php

use G4\ValueObject\Device;

class DeviceTest extends PHPUnit_Framework_TestCase
{

    public function testMobile()
    {
        $this->assertEquals('mobile', (string) new Device(Device::MOBILE));
        $this->assertEquals('mobile', (string) Device::createMobile());
    }

    public function testTablet()
    {
        $this->assertEquals('tablet', (string) new Device(Device::TABLET));
        $this->assertEquals('tablet', (string) Device::createTablet());
    }

    public function testDesktop()
    {
        $this->assertEquals('desktop', (string) new Device(Device::DESKTOP));
        $this->assertEquals('desktop', (string) Device::createDesktop());
    }

    public function testInvalidDevice()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidDeviceValueException::class);
        new Device('hamster');
    }
}