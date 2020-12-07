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
        $value = trim($value);
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
     * @return StringLiteral
     */
    public function diff(DomainName $domainName)
    {
        $diff = str_replace($domainName->__toString(), '', $this->__toString());
        $diff = preg_replace('/\.$/xuis', '', $diff);
        return new StringLiteral($diff);
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
        // todo after updating library jeremykendall/php-domain-parser to v6 implement caching
        $rules = \Pdp\Rules::createFromPath(__DIR__. '/../external/mozilla/public_suffix_list.dat');
        $domain = $rules->resolve($this->__toString())->getRegistrableDomain();
        return new self($domain);
    }

    /**
     * @return DomainName
     */
    public function getTopLevelDomainName()
    {
        preg_match('/\.((?!\d+)[a-zA-Zå\d]{1,63})$/xuis', $this->__toString(), $matches);

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
     * @param StringInterface[] ...$value
     * @return DomainName
     */
    public function truncate(StringInterface ...$value)
    {
        $parts = explode(self::DELIMITER, $this->__toString());
        $truncated = array_diff($parts, $value);
        return new self(join(self::DELIMITER, $truncated));
    }

    /**
     * @param $value
     * @return bool
     */
    private function isValid($value)
    {
        return \is_string($value)
            && preg_match(
                '/^(?!\-)(?:[a-zA-Zå\d\-]{0,62}[a-zA-Zå\d]\.){1,126}(?!\d+)[a-zA-Zå\d]{1,63}$/uxis',
                $value
            ) === 1;
    }
}
