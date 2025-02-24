<?php

use G4\ValueObject\Environment;
use G4\ValueObject\Exception\InvalidEnvironment;

class EnvironmentTest extends \PHPUnit\Framework\TestCase
{

    public function testInvalidEnvironment()
    {
        $this->expectException(InvalidEnvironment::class);

        new Environment('tralala');
    }

    public function testValidEnvironment()
    {
        $this->assertEquals('production', new Environment('production'));
        $this->assertEquals('production-migration', new Environment('production-migration'));
        $this->assertEquals('stage', new Environment('stage'));
        $this->assertEquals('dev', new Environment('dev'));
        $this->assertEquals('local', new Environment('local'));
        $this->assertEquals('vagrant', new Environment('vagrant'));
        $this->assertEquals('docker', new Environment('docker'));
    }

    public function testIsMethods()
    {
        $this->assertTrue((new Environment('production'))->isProduction());
        $this->assertTrue((new Environment('stage'))->isStage());
        $this->assertTrue((new Environment('dev'))->isDev());
        $this->assertTrue((new Environment('local'))->isLocal());
        $this->assertTrue((new Environment('vagrant'))->isLocal());
        $this->assertTrue((new Environment('beta'))->isBeta());
        $this->assertTrue((new Environment('docker'))->isDocker());
        $this->assertTrue((new Environment('production-migration'))->isProductionMigration());
        $this->assertTrue((new Environment('production-migration'))->isProductionEnvironment());
        $this->assertTrue((new Environment('production'))->isProductionEnvironment());
        $this->assertTrue((new Environment('beta'))->isProductionEnvironment());
    }
}