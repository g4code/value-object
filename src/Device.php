<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidDeviceValueException;

class Device
{

    const MOBILE  = 'mobile';
    const TABLET  = 'tablet';
    const DESKTOP = 'desktop';

    private $value;

    public function __construct($value)
    {
        if(!$this->validateDevice($value)){
            throw new InvalidDeviceValueException($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public static function createMobile()
    {
        return new self(self::MOBILE);
    }

    public static function createTablet()
    {
        return new self(self::TABLET);
    }

    public static function createDesktop()
    {
        return new self(self::DESKTOP);
    }

    private function validateDevice($value)
    {
        return
            $value === self::MOBILE ||
            $value === self::TABLET ||
            $value === self::DESKTOP;
    }

}
