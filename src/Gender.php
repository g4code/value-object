<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidGenderException;
use G4\ValueObject\Exception\InvalidGenderKeyException;

class Gender
{

    const MALE         = 'M';
    const FEMALE       = 'F';
    const KEY_MALE     = 1;
    const KEY_FEMALE   = 2;

    private $data;

    private static $genderMap = [
        self::MALE => [
            'type'   => 'Male',
            'name'   => 'Man',
            'plural' => 'Men',
            'key'    => self::KEY_MALE
        ],
        self::FEMALE => [
            'type'   => 'Female',
            'name'   => 'Woman',
            'plural' => 'Women',
            'key'    => self::KEY_FEMALE
        ],
    ];

    /**
     * Gender constructor.
     * @param $value
     * @throws InvalidGenderException
     */
    public function __construct($value)
    {
        if (!array_key_exists($value, self::$genderMap)) {
            throw new InvalidGenderException($value);
        }
        $this->data = $value;
    }

    public function __toString()
    {
        return (string)$this->data;
    }

    /**
     * @deprecated use magic method __toString instead
     */
    public function getGender()
    {
        return $this->data;
    }

    public function getGenderName()
    {
        return self::$genderMap[$this->data]['name'];
    }

    public function getGenderPlural()
    {
        return self::$genderMap[$this->data]['plural'];
    }

    public function getGenderType()
    {
        return self::$genderMap[$this->data]['type'];
    }

    public function getOpposite()
    {
        return $this->data === 'M'
            ? 'F'
            : 'M' ;
    }

    public function getGenderTypeLowercase()
    {
        return strtolower(self::$genderMap[$this->data]['type']);
    }

    public function getGenderOppositeTypeLowercase()
    {
        return strtolower(self::$genderMap[$this->getOpposite()]['type']);
    }

    public function getGenderKey()
    {
        return self::$genderMap[$this->data]['key'];
    }

    public function getOppositeGenderKey()
    {
        return self::$genderMap[$this->getOpposite()]['key'];
    }

    public static function createMale()
    {
        return new self(self::MALE);
    }

    public static function createFemale()
    {
        return new self(self::FEMALE);
    }

    /**
     * @param $key
     * @return Gender
     * @throws InvalidGenderKeyException
     */
    public static function createFromKey($key)
    {
        foreach (self::$genderMap as $name => $data) {
            if ($data['key'] == $key) {
                return new self($name);
            }
        }
        throw new InvalidGenderKeyException($key);
    }

    /**
     * @return Gender
     */
    public function createOpposite()
    {
        return new self($this->getOpposite());
    }
}