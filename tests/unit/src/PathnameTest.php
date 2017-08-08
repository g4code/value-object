<?php

use G4\ValueObject\Pathname;

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
}