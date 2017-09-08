<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidDomainNameException;

class DomainName implements StringInterface
{

    const DELIMITER = '.';

    /**
     * @var string
     */
    private $value;

    /**
     * DomainName constructor.
     * @param $value
     * @throws InvalidDomainNameException
     */
    public function __construct($value)
    {
        if (!$this->isValid($value)) {
            throw new InvalidDomainNameException($value);
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
     * @param DomainName $domainName
     * @return bool
     */
    public function equals(DomainName $domainName)
    {
        return $this->__toString() === $domainName->__toString();
    }

    /**
     * @return DomainName
     */
    public function getFirstLevelDomainName()
    {
        preg_match('/(^|\.)((?!\d+)[a-zA-Z\d]{1,63}\.(?!\d+)[a-zA-Z\d]{1,63})$/uxis', $this->__toString(), $matches);

        return new self($matches[2]);
    }

    /**
     * @return DomainName
     */
    public function getTopLevelDomainName()
    {
        preg_match('/\.((?!\d+)[a-zA-Z\d]{1,63})$/xuis', $this->__toString(), $matches);

        return new StringLiteral($matches[1]);
    }

    /**
     * @param StringInterface[] ...$value
     * @return DomainName
     */
    public function append(StringInterface ...$value)
    {
        array_unshift($value, $this->__toString());
        return new self(join(self::DELIMITER, $value));
    }

    /**
     * @param StringInterface[] ...$value
     * @return DomainName
     */
    public function prepend(StringInterface ...$value)
    {
        array_push($value, $this->__toString());
        return new self(join(self::DELIMITER, $value));
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return \is_string($value)
            && preg_match('/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/uxis', $value) === 1;
    }
}