<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidUuidException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * Uuid constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        if (! RamseyUuid::isValid($value)) {
            throw new InvalidUuidException($value);
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
     * @return string
     */
    public static function generate()
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}
