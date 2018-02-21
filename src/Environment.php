<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidEnvironment;

class Environment implements StringInterface
{
    const PRODUCTION    = 'production';
    const BETA          = 'beta';
    const STAGE         = 'stage';
    const DEV           = 'dev';
    const LOCAL         = 'local';
    const VAGRANT       = 'vagrant';

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

    public function isProduction()
    {
        return $this->value === self::PRODUCTION;
    }

    public function isBeta()
    {
        return $this->value === self::BETA;
    }

    public function isStage()
    {
        return $this->value === self::STAGE;
    }

    public function isDev()
    {
        return $this->value === self::DEV;
    }

    public function isLocal()
    {
        return $this->value === self::LOCAL
            || $this->value === self::VAGRANT;
    }

    private function isValid($value)
    {
        return in_array($value, [
            self::PRODUCTION,
            self::BETA,
            self::STAGE,
            self::DEV,
            self::LOCAL,
            self::VAGRANT,
        ]);
    }
}
