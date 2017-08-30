<?php

namespace G4\ValueObject\Exception;


namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidBase64Encoded;

class Base64Encoded
{
    private $encodedBytes;

    public function __construct($encodedBytes)
    {
        if (!base64_decode($encodedBytes, true)) {
            throw new InvalidBase64Encoded($encodedBytes);
        }

        $this->encodedBytes = $encodedBytes;
    }

    public function __toString()
    {
        return (string) $this->encodedBytes;
    }
}