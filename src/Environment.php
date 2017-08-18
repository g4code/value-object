<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidEnvironment;

class Environment implements StringInterface
{
    const PRODUCTION    = 'production';
    const STAGE         = 'stage';
    const DEV           = 'dev';
    const LOCAL         = 'local';

    /**
     * @var string
     */
    private $value;

    /**
     * Environment constructor.
     * @param string $value
     * @throws InvalidEnvironment
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidEnvironment($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    private function isValid($value)
    {
        return in_array($value, [
            self::PRODUCTION,
            self::STAGE,
            self::DEV,
            self::LOCAL,
        ]);
    }
}