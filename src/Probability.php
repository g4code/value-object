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
        //$chances array, in getOutcome(), starts from index 0, and random can be from 1 to 100;
        return new static(rand(self::MINIMAL_CHANCE, self::CERTAIN) - 1);
    }

    /**
     * @param Dictionary $possibilities
     * @return int
     * @throws InvalidProbabilityOutcomeException
     */
    public function getOutcome(Dictionary $possibilities)
    {
        try {
            $chances = [];
            $probabilityTotal = 0;

            foreach ($possibilities->getAll() as $returnValue => $probability) {
                $chances = $chances + array_fill(count($chances), $probability, $returnValue);
                $probabilityTotal += $probability;
            }

            if (count($chances) < 100) {
                $chances = $chances + array_fill(count($chances), 100 - $probabilityTotal, 0);
            }

            shuffle($chances);

            $retunValueSelected = $chances[$this->getValue()];

            return $retunValueSelected;

        } catch (\Exception $e) {
            throw new InvalidProbabilityOutcomeException($this->getValue(), json_encode($possibilities->getAll()));
        }
    }
}
