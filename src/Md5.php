<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidMd5Exception;
use G4\ValueObject\Exception\MissingMd5ValueException;

class Md5
{

    /**
     * @var string
     */
    private $value;

    /**
     * Md5 constructor.
     * @param $value
     * @throws MissingMd5ValueException
     * @throws InvalidMd5Exception
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingMd5ValueException();
        }

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
     * @param Md5 $value
     * @return bool
     */
    public function equals(Md5 $value)
    {
        return $this->value === $value->__toString();
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
