<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidStringLiteralException;


class StringLiteral implements StringInterface
{

    /**
     * @var string
     */
    private $value;

    /**
     * StringLiteral constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        if(!\is_string($value)) {
            throw new InvalidStringLiteralException($value);
        }

        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}