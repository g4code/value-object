<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingCoordinateValueException;
use G4\ValueObject\Exception\InvalidCoordinateLatitudeValueException;
use G4\ValueObject\Exception\InvalidCoordinateLongitudeValueException;

class Coordinate implements StringInterface
{
    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * Coordinate constructor.
     * @param $latitude
     * @param $longitude
     * @throws MissingCoordinateValueException
     * @throws InvalidCoordinateLatitudeValueException
     * @throws InvalidCoordinateLongitudeValueException
     */
    public function __construct($latitude, $longitude)
    {
        if (empty($latitude) || empty($longitude)) {
            throw new MissingCoordinateValueException();
        }

        if (!$this->isValidLatitude($latitude) || !self::isValidLatitude($latitude)) {
            throw new InvalidCoordinateLatitudeValueException($latitude);
        }

        if (!$this->isValidLongitude($longitude) || !self::isValidLongitude($longitude)) {
            throw new InvalidCoordinateLongitudeValueException($longitude);
        }

        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return join(',', [$this->latitude, $this->longitude]);
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return (string) $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return (string) $this->longitude;
    }

    /**
     * @param Coordinate $coordinate
     * @return bool
     */
    public function equals(Coordinate $coordinate)
    {
        return $this->__toString() === $coordinate->__toString();
    }

    /**
     * @param $numberOfDecimals
     * @return Coordinate
     */
    public function round(NumberInterface $numberOfDecimals)
    {
        $latitude  = round($this->latitude, $numberOfDecimals->getValue());
        $longitude = round($this->longitude, $numberOfDecimals->getValue());
        return new Coordinate($latitude, $longitude);
    }

    /**
     * @param $latitude
     * @return bool
     */
    public static function isValidLatitude($latitude)
    {
        return preg_match('/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d/', $latitude) == 1;
    }

    /**
     * @param $longitude
     * @return bool
     */
    public static function isValidLongitude($longitude)
    {
        return preg_match('/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d/', $longitude) == 1;
    }
}
