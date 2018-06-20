<?php

use G4\ValueObject\Coordinate;
use G4\ValueObject\IntegerNumber;
use G4\ValueObject\Exception\MissingCoordinateValueException;
use G4\ValueObject\Exception\InvalidCoordinateLatitudeValueException;
use G4\ValueObject\Exception\InvalidCoordinateLongitudeValueException;

class CoordinateTest extends PHPUnit_Framework_TestCase
{
    public function testWithValidCoordinate()
    {
        $coordinate = new Coordinate('-56.130366', '-106.34677099999999');
        $this->assertEquals('-56.130366,-106.34677099999999', (string) $coordinate);
        $this->assertEquals('-56.130366', $coordinate->getLatitude());
        $this->assertEquals('-106.34677099999999', $coordinate->getLongitude());

        $coordinate = new Coordinate('43.333146', '21.930728');
        $this->assertEquals('43.333146,21.930728', (string) $coordinate);
        $this->assertEquals('43.333146', $coordinate->getLatitude());
        $this->assertEquals('21.930728', $coordinate->getLongitude());

        $coordinate = new Coordinate(43.333146, 21.930728);
        $this->assertEquals('43.333146,21.930728', (string) $coordinate);
        $this->assertEquals('43.333146', $coordinate->getLatitude());
        $this->assertEquals('21.930728', $coordinate->getLongitude());


        $coordinate = new Coordinate('0.0000', '25.0000');
        $this->assertEquals('0.0000,25.0000', (string) $coordinate);
        $this->assertEquals('0.0000', $coordinate->getLatitude());
        $this->assertEquals('25.0000', $coordinate->getLongitude());

        $coordinate = new Coordinate('-90.0000', '-180.0000');
        $this->assertEquals('-90.0000,-180.0000', (string) $coordinate);
        $this->assertEquals('-90.0000', $coordinate->getLatitude());
        $this->assertEquals('-180.0000', $coordinate->getLongitude());

        $coordinate = new Coordinate('90.0000', '180.0000');
        $this->assertEquals('90.0000,180.0000', (string) $coordinate);
        $this->assertEquals('90.0000', $coordinate->getLatitude());
        $this->assertEquals('180.0000', $coordinate->getLongitude());
    }

    public function testRound()
    {
        $coordinate    = new Coordinate('43.333158742', '21.930728893');
        $newCoordinate = $coordinate->round(new IntegerNumber(7));

        $this->assertEquals('43.3331587,21.9307289', (string) $newCoordinate);
        $this->assertEquals('43.3331587', $newCoordinate->getLatitude());
        $this->assertEquals('21.9307289', $newCoordinate->getLongitude());

        $this->assertInstanceOf(Coordinate::class, $newCoordinate);
        $this->assertNotSame($newCoordinate, $coordinate);
    }

    public function testEquals()
    {
        $coordinate    = new Coordinate('43.333146', '21.930728');
        $coordinateNew = new Coordinate('43.333147', '21.930725');
        $this->assertFalse($coordinate->equals($coordinateNew));

        $coordinate    = new Coordinate('43.333146', '21.930728');
        $coordinateNew = new Coordinate('43.333146', '21.930728');
        $this->assertTrue($coordinate->equals($coordinateNew));
    }

    public function testWithEmptyCoordinate()
    {
        $this->expectException(MissingCoordinateValueException::class);
        new Coordinate('', '');
    }

    public function testWithEmptyLatitudeCoordinate()
    {
        $this->expectException(MissingCoordinateValueException::class);
        new Coordinate(' ', '21.930728');
    }

    public function testWithEmptyLongitudeCoordinate()
    {
        $this->expectException(MissingCoordinateValueException::class);
        new Coordinate('43.333146', ' ');
    }

    public function testWithInvalidCoordinates()
    {
        $this->expectException(InvalidCoordinateLatitudeValueException::class);
        new Coordinate('103.333146', '201.930728');

        $this->expectException(InvalidCoordinateLatitudeValueException::class);
        new Coordinate('-95.333146', '-190.930728');
    }

    public function testWithStringLatitudeCoordinate()
    {
        $this->expectException(MissingCoordinateValueException::class);
        new Coordinate('one', '21.930728');
    }

    public function testWithStringLongitudeCoordinate()
    {
        $this->expectException(MissingCoordinateValueException::class);
        new Coordinate('43.333146', 'ten');
    }

//    public function testLatitudeExceptionWithInteger()
//    {
//        $this->expectException(InvalidCoordinateLatitudeValueException::class);
//        new Coordinate(43, 21.930728);
//    }

//    public function testLongitudeExceptionWithInteger()
//    {
//        $this->expectException(InvalidCoordinateLongitudeValueException::class);
//        new Coordinate(43.333146, 21);
//    }
}
