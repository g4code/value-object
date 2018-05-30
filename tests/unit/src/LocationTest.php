<?php

use G4\ValueObject\Dictionary;
use G4\ValueObject\Exception\InvalidLocationException;
use G4\ValueObject\Location;

class LocationTest extends PHPUnit_Framework_TestCase
{
    public function testAddQuery()
    {
        $location = new Location('example.com/page');

        $this->assertEquals('example.com/page?q=search', $location->addQuery(new Dictionary(['q' => 'search'])));
    }

    public function testLocationException()
    {
        $this->expectException(InvalidLocationException::class);

        new Location('*abc');
    }

}
