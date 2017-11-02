<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidGenderException;

class Gender
{

    const MALE   = 'M';
    const FEMALE = 'F';

    private $data;

    private $genderMap = [
        'M' => [
            'type'   => 'Male',
            'name'   => 'Man',
            'plural' => 'Men',
            'key'    => 1
        ],
        'F' => [
            'type'   => 'Female',
            'name'   => 'Woman',
            'plural' => 'Women',
            'key'    => 2
        ],
    ];

    /**
     * Gender constructor.
     * @param $value
     * @throws InvalidGenderException
     */
    public function __construct($value)
    {
        if (!array_key_exists($value, $this->genderMap)) {
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
        return $this->genderMap[$this->data]['name'];
    }

    public function getGenderPlural()
    {
        return $this->genderMap[$this->data]['plural'];
    }

    public function getGenderType()
    {
        return $this->genderMap[$this->data]['type'];
    }

    public function getOpposite()
    {
        return $this->data === 'M'
            ? 'F'
            : 'M' ;
    }

    public function getGenderTypeLowercase()
    {
        return strtolower($this->genderMap[$this->data]['type']);
    }

    public function getGenderOppositeTypeLowercase()
    {
        return strtolower($this->genderMap[$this->getOpposite()]['type']);
    }

    public function getGenderKey()
    {
        return $this->genderMap[$this->data]['key'];
    }

    public function getOppositeGenderKey()
    {
        return $this->genderMap[$this->getOpposite()]['key'];
    }

    public static function createMale()
    {
        return new self(self::MALE);
    }

    public static function createFemale()
    {
        return new self(self::FEMALE);
    }
}
