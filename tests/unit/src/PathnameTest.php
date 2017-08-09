<?php

use G4\ValueObject\Pathname;
use G4\ValueObject\StringLiteral;

class PathnameTest extends \PHPUnit_Framework_TestCase
{


    public function testToString()
    {
        $path = new Pathname(__DIR__, 'PathnameTest.php');

        $this->assertEquals(__FILE__, (string) $path);
    }

    public function testMissingDirs()
    {
        $this->expectException(\G4\ValueObject\Exception\MissingDirsException::class);
        new Pathname();
    }

    public function testDiff()
    {
        $diff = (new Pathname(__FILE__))->diff(new Pathname(__DIR__));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('/PathnameTest.php', (string) $diff);
    }
}