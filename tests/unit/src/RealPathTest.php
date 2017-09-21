<?php

use G4\ValueObject\RealPath;
use G4\ValueObject\StringLiteral;
use G4\ValueObject\Exception\PathDoesNotExist;


class RealPathTest extends \PHPUnit_Framework_TestCase
{


    public function testToString()
    {
        $path = new RealPath(__DIR__, basename(__FILE__));

        $this->assertEquals(__FILE__, (string) $path);
    }

    public function testInvalidPath()
    {
        $this->expectException(PathDoesNotExist::class);
        (string) (new RealPath(__DIR__, 'path'));
    }

    public function testDiff()
    {
        $diff = (new RealPath(__FILE__))->diff(new RealPath(__DIR__));

        $this->assertInstanceOf(StringLiteral::class, $diff);
        $this->assertEquals('/RealPathTest.php', (string) $diff);
    }

    public function testAppend()
    {
        $realPathDir = new RealPath(__DIR__);
        $realPathFile = $realPathDir->append(basename(__FILE__));

        $this->assertInstanceOf(RealPath::class, $realPathFile);
        $this->assertEquals(__FILE__, (string) $realPathFile);
    }


}