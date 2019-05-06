<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidIntegerNumberException;
use G4\ValueObject\Exception\InvalidProbabilityException;
use G4\ValueObject\Exception\InvalidProbabilityOutcomeException;

class Probability extends IntegerNumber
{
    const IMPOSSIBLE     = 0;
    const MINIMAL_CHANCE = 1;
    const CERTAIN        = 100;

    /**
     * Probability constructor.
     * @param $value
     * @throws InvalidProbabilityException
     * @throws InvalidIntegerNumberException
     */
    public function __construct($value)
    {
        parent::__construct($value);
        if (!self::isValid($this->getValue())) {
            throw new InvalidProbabilityException($value);
        }
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isValid($value)
    {
        return $value >= self::IMPOSSIBLE && $value <= self::CERTAIN;
    }

    /**
     * @return Probability
     */
    public static function generateRandomWithChance()
    {
        return new static(rand(self::MINIMAL_CHANCE, self::CERTAIN));
    }

    /**
     * @param Dictionary $possibilities
     * @return int
     * @throws InvalidProbabilityOutcomeException
     */
    public function getOutcome(Dictionary $possibilities)
    {
        $mapOfChances = [];
        $previousValue = null;
        foreach ($possibilities->getAll() as $key => $value) {
            $mapOfChances[$key] = $value + $previousValue;
            $previousValue += $value;
        }
        foreach ($mapOfChances as $key => $value) {
            if ($this->getValue() <= $value) {
                return $key;
            }
        }
        throw new InvalidProbabilityOutcomeException($this->getValue(), json_encode($possibilities->getAll()));
    }
}
