<?php

use G4\ValueObject\ArrayList;
use G4\ValueObject\StringLiteral;

class ArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function testHas()
    {
        $anArrayList = new ArrayList(['a' => 'a path']);
        $this->assertFalse($anArrayList->has('b'));
        $this->assertTrue($anArrayList->has('a'));

        $anArrayList = new ArrayList([]);
        $this->assertFalse($anArrayList->has('a'));
    }

    public function testHasNonEmptyValue()
    {
        $anArrayList = new ArrayList(['a' => 'a path']);
        $this->assertTrue($anArrayList->hasNonEmptyValue('a'));
        $this->assertFalse($anArrayList->hasNonEmptyValue('b'));

        $anArrayList = new ArrayList(['a' => ['b' => 'c']]);
        $this->assertTrue($anArrayList->hasNonEmptyValue('a'));

        $anArrayList = new ArrayList(['a' => '']);
        $this->assertFalse($anArrayList->hasNonEmptyValue('a'));

        $anArrayList = new ArrayList(['a' => 0]);
        $this->assertFalse($anArrayList->hasNonEmptyValue('a'));

        $anArrayList = new ArrayList(['a' => []]);
        $this->assertFalse($anArrayList->hasNonEmptyValue('a'));

        $anArrayList = new ArrayList([]);
        $this->assertFalse($anArrayList->hasNonEmptyValue('a'));
        $this->assertFalse($anArrayList->hasNonEmptyValue(''));
    }

    public function testGet()
    {
        $anArrayList = new ArrayList(['a' => 'a path']);
        $this->assertEquals('a path', $anArrayList->get('a'));
        $this->assertNull($anArrayList->get('b'));

        $anArrayList = new ArrayList([]);
        $this->assertNull(null, $anArrayList->get('a'));
    }

    public function testGetAll()
    {
        $this->assertEquals(['key' => 'value'], (new ArrayList(['key' => 'value']))->getAll());
        $this->assertEquals([], (new ArrayList([]))->getAll());
    }

    public function testHasKeys()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertTrue($anArrayList->hasKeys(['key1', 'key2', 'key3']));
        $this->assertFalse($anArrayList->hasKeys(['key432', 'key342', 'key5487']));

        $anArrayList = new ArrayList([]);
        $this->assertFalse($anArrayList->hasKeys(['key1', 'key2']));
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
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ]);
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ], $anArrayList->getAll());

        $anArrayList->add('key4', 'value4');
        $this->assertEquals([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
            'key4' => 'value4',
        ], $anArrayList->getAll());
    }

    public function testCount()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertEquals(3, $anArrayList->count());
    }

    public function testEquals()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $anArrayList = new ArrayList($data);

        $this->assertTrue($anArrayList->equals(new ArrayList($data)));
        $this->assertTrue($anArrayList->equals(new ArrayList([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ])));
        $this->assertFalse($anArrayList->equals(new ArrayList([
            'key1' => 'value1',
            'key3' => 'value3',
        ])));
    }

    public function testRemoveIfKeyExists()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertArrayHasKey('key2', $anArrayList->getAll());
        $this->assertCount(3, $anArrayList->getAll());
        $this->assertEquals($data, $anArrayList->getAll());

        $anArrayListNew = $anArrayList->remove('key2');
        $this->assertArrayNotHasKey('key2', $anArrayListNew->getAll());
        $this->assertCount(2, $anArrayListNew->getAll());
        $this->assertEquals([
            'key1' => 'value1',
            'key3' => 'value3',
        ], $anArrayList->getAll());
    }

    public function testRemoveIfKeyDoesNotExist()
    {
        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ];

        $anArrayList = new ArrayList($data);
        $this->assertArrayNotHasKey('key4', $anArrayList->getAll());
        $this->assertCount(3, $anArrayList->getAll());
        $this->assertEquals($data, $anArrayList->getAll());

        $anArrayListNew = $anArrayList->remove('key4');
        $this->assertArrayNotHasKey('key4', $anArrayListNew->getAll());
        $this->assertCount(3, $anArrayListNew->getAll());
        $this->assertEquals($data, $anArrayList->getAll());
    }

    public function testHasNotNullValue()
    {
        $anArrayList = new ArrayList([
            'key1' => 'value',
            'key2' => null,
        ]);

        $this->assertTrue($anArrayList->hasNotNullValue('key1'));
        $this->assertFalse($anArrayList->hasNotNullValue('key2'));
    }
}
