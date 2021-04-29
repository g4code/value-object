<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidUuidHexException;
use Ramsey\Uuid\Codec\TimestampFirstCombCodec;
use Ramsey\Uuid\Generator\CombGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

class UuidHex
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $uuid;

    /**
     * UuidHex constructor.
     * @param string $value
     * @throws InvalidUuidHexException
     */
    public function __construct($value)
    {
        if (!$this->isHex($value) || !Uuid::isValid($this->toUuid($value))) {
            throw new InvalidUuidHexException($value);
        }

        $this->uuid = $this->toUuid($value);
        $this->value = $value;
    }

    /**
     * @return self
     */
    public static function generate()
    {
        $factory = new UuidFactory();

        $factory->setCodec(new TimestampFirstCombCodec($factory->getUuidBuilder()));

        $factory->setRandomGenerator(new CombGenerator(
            $factory->getRandomGenerator(),
            $factory->getNumberConverter()
        ));

        return new static($factory->uuid4()->getHex());
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
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param $value
     * @return string
     */
    private function toUuid($value)
    {
        return (new UuidFactory())->fromBytes(hex2bin($value))->toString();
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isHex($string)
    {
        return @preg_match("/^[a-f0-9]{2,}$/i", $string) && !(strlen($string) & 1);
    }
}