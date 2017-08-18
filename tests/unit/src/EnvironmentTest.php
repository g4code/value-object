<?php

use G4\ValueObject\Environment;
use G4\ValueObject\Exception\InvalidEnvironment;

class EnvironmentTest extends PHPUnit_Framework_TestCase
{

    public function testInvalidEnvironment()
    {
        $this->expectException(InvalidEnvironment::class);

        new Environment('tralala');
    }

    public function testValidEnvironment()
    {
        $this->assertEquals('production', new Environment('production'));
        $this->assertEquals('stage', new Environment('stage'));
        $this->assertEquals('dev', new Environment('dev'));
        $this->assertEquals('local', new Environment('local'));
    }

    public function testIsMethods()
    {
        $this->assertTrue((new Environment('production'))->isProduction());
        $this->assertTrue((new Environment('stage'))->isStage());
        $this->assertTrue((new Environment('dev'))->isDev());
        $this->assertTrue((new Environment('local'))->isLocal());
    }
}