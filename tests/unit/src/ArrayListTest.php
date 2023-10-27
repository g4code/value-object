<?php

use G4\ValueObject\ArrayList;
use G4\ValueObject\StringLiteral;

class ArrayListTest extends \PHPUnit\Framework\TestCase
{
    public function testHas()
    {
        $anArrayList = new ArrayList(['a path']);
        $this->assertFalse($anArrayList->has('b'));
        $this->assertTrue($anArrayList->has('a path'));

        $anArrayList = new ArrayList([]);
        $this->assertFalse($anArrayList->has('a'));
    }

    public function testGetAll()
    {
        $this->assertEquals(['value'], (new ArrayList(['value']))->getAll());
        $this->assertEquals([], (new ArrayList([]))->getAll());
    }

    public function testToString()
    {
        $anArrayList = new ArrayList(['tags1', 'tags2', 'tags3']);
        $this->assertEquals('tags1tags2tags3', $anArrayList->toString());
        $this->assertEquals('tags1|tags2|tags3', $anArrayList->toString(new StringLiteral('|')));
        $this->assertEquals('tags1-tags2-tags3', $anArrayList->toString(new StringLiteral('-')));

        $anArrayList = new ArrayList([]);
        $this->assertEmpty($anArrayList->toString());
        $this->assertEmpty($anArrayList->toString(new StringLiteral('|')));
        $this->assertEmpty($anArrayList->toString(new StringLiteral('-')));
    }

    public function testAdd()
    {
        $anArrayList = new ArrayList([
            'value1',
            'value2',
            'value3',
        ]);
        $this->assertEquals([
            'value1',
            'value2',
            'value3',
        ], $anArrayList->getAll());

        $anArrayList->add('value4');
        $this->assertEquals([
            'value1',
            'value2',
            'value3',
            'value4',
        ], $anArrayList->getAll());
    }

    public function testCount()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertEquals(3, $anArrayList->count());
    }

    public function testEquals()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);

        $this->assertTrue($anArrayList->equals(new ArrayList($data)));
        $this->assertTrue($anArrayList->equals(new ArrayList([
            'value1',
            'value2',
            'value3',
        ])));
        $this->assertFalse($anArrayList->equals(new ArrayList([
            'value1',
            'value3',
        ])));
    }

    public function testRemove()
    {
        $data = [
            'value1',
            'value2',
            'value3',
        ];

        $anArrayList = new ArrayList($data);

        $newArrayList = $anArrayList->remove('value2');

        $this->assertEquals($data, $anArrayList->getAll());
        $this->assertEquals(['value1', 'value3'], $newArrayList->getAll());
    }
}
