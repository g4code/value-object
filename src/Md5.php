<?php

namespace G4\ValueObject;


use G4\ValueObject\Exception\InvalidMd5Exception;

class Md5
{

    /**
     * @var string
     */
    private $value;

    /**
     * Md5 constructor.
     * @param $value
     */
    public function __construct($value)
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $value)) {
            throw new InvalidMd5Exception($value);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return Md5
     */
    public static function calculateMd5($value)
    {
        return new self(md5($value));
    }
}