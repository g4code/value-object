<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidAssetsUrlValueException;

class AssetsUrl implements StringInterface
{
    const DEFAULT_PREPEND_VALUE = '//';

    /**
     * @var string
     */
    private $value;

    /**
     * AssetsUrl constructor.
     * @param $value
     * @throws InvalidAssetsUrlValueException
     */
    public function __construct($value)
    {
        if (!\is_string($value) || strlen($value) === 0) {
            throw new InvalidAssetsUrlValueException($value);
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->isHttpOrHttps()
            ? $this->cleanUrlProtocol()
            : $this->value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param AssetsUrl $value
     * @return bool
     */
    public function equals(AssetsUrl $value)
    {
        return $this->value === $value->__toString();
    }

    /**
     * @param StringInterface $prepend
     * @return AssetsUrl
     */
    public function prepend(StringInterface $prepend = self::DEFAULT_PREPEND_VALUE)
    {
        $modified = $prepend . $this->value;
        return new AssetsUrl($modified);
    }

    /**
     * @return bool
     */
    private function isHttpOrHttps()
    {
        return preg_match("((http|https)?://)", $this->value) === 1;
    }

    /**
     * @return string
     */
    private function cleanUrlProtocol()
    {
        return preg_replace("((http|https)?://)", "", $this->value);
    }
}
