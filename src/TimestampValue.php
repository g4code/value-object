<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\MissingTimestampValueException;
use G4\ValueObject\Exception\InvalidTimestampValueException;

class TimestampValue implements StringInterface, NumberInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * TimestampValue constructor.
     * @param $value
     * @throws MissingTimestampValueException
     * @throws InvalidTimestampValueException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingTimestampValueException();
        }

        if (!self::isValid($value)) {
            throw new InvalidTimestampValueException($value);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return (int) $this->value;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFormatted($format = 'Y-m-d')
    {
        return date($format, $this->value);
    }

    /**
     * @return string
     */
    public function getMilliseconds()
    {
        return (int) $this->value * 1000;
    }

    /**
     * @param $timestamp
     * @return bool
     */
    public static function isValid($timestamp)
    {
        $check = (is_int($timestamp) || is_float($timestamp))
            ? $timestamp
            : (string) (int) $timestamp;

        return ($check === $timestamp) && ((int) $timestamp <= PHP_INT_MAX) && ((int) $timestamp >= ~PHP_INT_MAX);
    }
}
