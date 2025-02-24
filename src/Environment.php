<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidEnvironment;

class Environment implements StringInterface
{
    const PRODUCTION = 'production';
    const PRODUCTION_MIGRATION = 'production-migration';
    const BETA = 'beta';
    const STAGE = 'stage';
    const DEV = 'dev';
    const LOCAL = 'local';
    const VAGRANT = 'vagrant';
    const DOCKER = 'docker';

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
            || $this->value === self::VAGRANT
            || $this->value === self::DOCKER;
    }

    public function isDocker()
    {
        return $this->value === self::DOCKER;
    }

    private function isValid($value)
    {
        return in_array($value, [
            self::PRODUCTION,
            self::PRODUCTION_MIGRATION,
            self::BETA,
            self::STAGE,
            self::DEV,
            self::LOCAL,
            self::VAGRANT,
            self::DOCKER,
        ]);
    }

    public function isProductionMigration()
    {
        return $this->value === self::PRODUCTION_MIGRATION;
    }

    public function isProductionEnvironment()
    {
        return $this->isProduction()
            || $this->isBeta()
            || $this->isProductionMigration();
    }
}
