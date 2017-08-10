<?php

use G4\ValueObject\Pathname;
use G4\ValueObject\StringLiteral;
use G4\ValueObject\Exception\MissingDirsException;
use G4\ValueObject\Exception\PathDoesNotExist;


class PathnameTest extends \PHPUnit_Framework_TestCase
{


    public function testToString()
    {
        $path = new Pathname(__DIR__, 'PathnameTest.php');

        $this->assertEquals(__FILE__, (string) $path);
    }

    public function testMissingDirs()
    {
        $this->expectException(MissingDirsException::class);
        new Pathname();
    }

    public function testInvalidPath()
    {
        $this->expectException(PathDoesNotExist::class);
        (string) (new Pathname(__DIR__, 'path'));
    }

    public function testDiff()
    {
        $diff = (new Pathname(__FILE__))->diff(new Pathname(__DIR__));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('/PathnameTest.php', (string) $diff);
    }
}