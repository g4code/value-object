<?php

use G4\ValueObject\UuidHex;

class UuidHexTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $uuidHex = UuidHex::generate();
        $this->assertInstanceOf(UuidHex::class, $uuidHex);
    }

    public function testWithValidHex()
    {
        $uuidHex = new UuidHex('934f14b8b32c4e72a49fd48ce394b656');
        $this->assertEquals('934f14b8b32c4e72a49fd48ce394b656', (string) $uuidHex);
    }

    public function testWithInvalidUuid()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidUuidHexException::class);
        new UuidHex('test123');
    }

    public function testGetUuid()
    {
        $uuidHex = new UuidHex('934f14b8b32c4e72a49fd48ce394b656');
        $this->assertSame('934f14b8-b32c-4e72-a49f-d48ce394b656', $uuidHex->getUuid());
    }
}