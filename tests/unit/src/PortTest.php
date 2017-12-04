<?php

use G4\ValueObject\PortNumber;
use G4\ValueObject\Exception\InvalidPortNumberException;

class PortTest extends \PHPUnit_Framework_TestCase
{
    public function testValidPortNumber()
    {
        $portNumber = new PortNumber(8080);
        $this->assertEquals(8080, $portNumber->getValue());

        $portNumber = new PortNumber('8080');
        $this->assertEquals(8080, $portNumber->getValue());
    }

    public function testToString()
    {
        $integerNumber = new PortNumber("8080");
        $this->assertEquals("8080", (string) $integerNumber);
    }

    public function testIrregularPortNumber()
    {
        $this->expectException(InvalidPortNumberException::class);
        new PortNumber(-5);

        $this->expectException(InvalidPortNumberException::class);
        new PortNumber(70000);

        $this->expectException(InvalidPortNumberException::class);
        new PortNumber("-65");

        $this->expectException(InvalidPortNumberException::class);
        new PortNumber("70001");
    }
}
