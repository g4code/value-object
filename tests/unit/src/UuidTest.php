<?php

use G4\ValueObject\Uuid;


class UuidTest extends \PHPUnit_Framework_TestCase
{

    public function testWithValidUuid()
    {
        $anUuid = new Uuid('d190bc0f-13d7-4cac-a8a6-40ae47d6d07a');
        $this->assertEquals('d190bc0f-13d7-4cac-a8a6-40ae47d6d07a', (string) $anUuid);
    }

    public function testWithInvalidUuid()
    {
        $this->expectException('\G4\ValueObject\Exception\InvalidUuidException');
        new Uuid('tralalalala');
    }

    public function testGenerate()
    {
        $anUuid = Uuid::generate();
        $this->isInstanceOf('\G4\ValueObject\Uuid', $anUuid);
    }
}