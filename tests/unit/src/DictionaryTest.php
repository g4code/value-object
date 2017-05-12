<?php

use G4\ValueObject\Dictionary;


class DictionaryTest extends \PHPUnit_Framework_TestCase
{


    public function testWithEmptyArray()
    {
        $this->expectException('\G4\ValueObject\Exception\InvalidDictionaryException');
        new Dictionary([]);
    }

    public function testHas()
    {
        $aDictianary = new Dictionary(['a' => 'a value']);
        $this->assertFalse($aDictianary->has('b'));
        $this->assertTrue($aDictianary->has('a'));
    }

    public function testGet()
    {
        $aDictionary = new Dictionary(['a' => 'a value']);
        $this->assertEquals('a value', $aDictionary->get('a'));
        $this->assertNull($aDictionary->get('b'));
    }
}