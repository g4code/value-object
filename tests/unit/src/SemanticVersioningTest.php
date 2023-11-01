<?php

use G4\ValueObject\SemanticVersioning;
use G4\ValueObject\Exception\InvalidSemanticVersioningException;

class SemanticVersioningTest extends \PHPUnit\Framework\TestCase
{
    public function testValidVersions()
    {
        $this->assertEquals('22.123.232', (string) new SemanticVersioning('22.123.232'));
        $this->assertEquals('2.123.232', (string) new SemanticVersioning('2.123.232'));
        $this->assertEquals('2.123.23', (string) new SemanticVersioning('2.123.23'));
        $this->assertEquals('2.12.23', (string) new SemanticVersioning('2.12.23'));
        $this->assertEquals('9.9.09', (string) new SemanticVersioning('9.9.09'));
    }

    public function testInvalidVersionOne()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning('1.1.1111');
    }

    public function testInvalidVersionTwo()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning('1.1222.111');
    }

    public function testInvalidVersionThree()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning('1223.122.111');
    }

    public function testInvalidVersionNull()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning(null);
    }

    public function testInvalidVersionBool()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning(false);
    }

    public function testInvalidVersionEmpty()
    {
        $this->expectException(InvalidSemanticVersioningException::class);
        new SemanticVersioning('');
    }
}