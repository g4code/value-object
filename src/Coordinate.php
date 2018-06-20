<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingCoordinateValueException;
use G4\ValueObject\Exception\InvalidCoordinateLatitudeValueException;
use G4\ValueObject\Exception\InvalidCoordinateLongitudeValueException;

class Coordinate implements StringInterface
{
    const LATITUDE_MIN_VALUE  = -90;
    const LATITUDE_MAX_VALUE  = 90;
    const LONGITUDE_MIN_VALUE = -180;
    const LONGITUDE_MAX_VALUE = 180;

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
        if (!is_numeric($latitude) || !is_numeric($longitude)) {
            throw new MissingCoordinateValueException();
        }

        if (!$this->isValidLatitude($latitude)) {
            throw new InvalidCoordinateLatitudeValueException($latitude);
        }

        if (!$this->isValidLongitude($longitude)) {
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
    public function isValidLatitude($latitude)
    {
        return $latitude >= self::LATITUDE_MIN_VALUE && $latitude <= self::LATITUDE_MAX_VALUE;
    }

    /**
     * @param $longitude
     * @return bool
     */
    public function isValidLongitude($longitude)
    {
        return $longitude >= self::LONGITUDE_MIN_VALUE && $longitude <= self::LONGITUDE_MAX_VALUE;
    }
}
