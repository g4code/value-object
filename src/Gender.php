<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidGenderException;
use G4\ValueObject\Exception\InvalidGenderKeyException;
use G4\ValueObject\Exception\MissingGenderOppositeException;

class Gender
{
    const MALE             = 'M';
    const FEMALE           = 'F';
    const COUPLE           = 'C';
    const NON_BINARY       = 'N';
    const KEY_MALE         = 1;
    const KEY_FEMALE       = 2;
    const KEY_COUPLE       = 3;
    const KEY_NON_BINARY   = 4;

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
        self::COUPLE => [
            'type'   => 'Couple',
            'name'   => 'Couple',
            'plural' => 'Couples',
            'key'    => self::KEY_COUPLE
        ],
        self::NON_BINARY => [
            'type'   => 'Non-Binary',
            'name'   => 'Non-Binary',
            'plural' => 'Non-Binaries',
            'key'    => self::KEY_NON_BINARY
        ],
    ];

    /**
     * Gender constructor.
     *
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

    /**
     * @return string
     */
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

    /**
     * @return string
     */
    public function getGenderName()
    {
        return self::$genderMap[$this->data]['name'];
    }

    /**
     * @return string
     */
    public function getGenderPlural()
    {
        return self::$genderMap[$this->data]['plural'];
    }

    /**
     * @return integer
     */
    public function getGenderType()
    {
        return self::$genderMap[$this->data]['type'];
    }

    /**
     * @return array
     * @throws MissingGenderOppositeException
     */
    public function getOpposite()
    {
        if ($this->data === self::FEMALE) {
            return [self::MALE];
        }

        if ($this->data === self::COUPLE) {
            return [self::MALE];
        }

        if ($this->data === self::MALE) {
            return [self::FEMALE, self::COUPLE];
        }

        if ($this->data === self::NON_BINARY) {
            return [self::FEMALE, self::NON_BINARY];
        }

        throw new MissingGenderOppositeException($this->data);
    }

    /**
     * @return array
     */
    public function getGenderOppositeTypesLowercase()
    {
        $types = [];

        foreach ($this->getOpposite() as $opposite) {
            $types[] = strtolower(self::$genderMap[$opposite]['type']);
        }

        return $types;
    }

    /**
     * @return array
     */
    public function getOppositeGenderKeys()
    {
        $keys = [];

        foreach ($this->getOpposite() as $opposite) {
            $keys[] = strtolower(self::$genderMap[$opposite]['key']);
        }

        return $keys;
    }

    /**
     * @return string
     */
    public function getGenderTypeLowercase()
    {
        return strtolower(self::$genderMap[$this->data]['type']);
    }

    /**
     * @return integer
     */
    public function getGenderKey()
    {
        return self::$genderMap[$this->data]['key'];
    }

    /**
     * @return Gender
     */
    public static function createMale()
    {
        return new self(self::MALE);
    }

    /**
     * @return Gender
     */
    public static function createFemale()
    {
        return new self(self::FEMALE);
    }

    /**
     * @return Gender
     */
    public static function createCouple()
    {
        return new self(self::COUPLE);
    }

    /**
     * @return Gender
     */
    public static function createNonBinary()
    {
        return new self(self::NON_BINARY);
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
}
