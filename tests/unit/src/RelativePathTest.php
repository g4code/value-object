<?php

use G4\ValueObject\RelativePath;
use G4\ValueObject\Exception\MissingDirsException;

class RelativePathTest extends \PHPUnit\Framework\TestCase
{

    public function testPath()
    {
        $relativePath = new RelativePath(__DIR__, 'RelativePathTest.php');
        $this->assertEquals(
            join(DIRECTORY_SEPARATOR, [__DIR__, 'RelativePathTest.php']),
            (string) $relativePath
        );
    }

    public function testMissingDirs()
    {
        $this->expectException(MissingDirsException::class);
        new RelativePath();
    }
}