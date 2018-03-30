<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidSha1Exception;
use G4\ValueObject\Exception\MissingSha1ValueException;

class Sha1
{
    /**
     * @var string
     */
    private $value;

    /**
     * Sha1 constructor.
     * @param $value
     * @throws InvalidSha1Exception
     * @throws MissingSha1ValueException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingSha1ValueException($value);
        }

        if (!preg_match('/^[0-9a-f]{40}$/i', $value)) {
            throw new InvalidSha1Exception($value);
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
     * @param Sha1 $value
     * @return bool
     */
    public function equals(Sha1 $value)
    {
        return $this->value === $value->__toString();
    }

    /**
     * @param $value
     * @return Sha1
     */
    public static function calculateSha1($value)
    {
        return new self(sha1($value));
    }
}
