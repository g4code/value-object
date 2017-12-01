<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidUrlException;

class Url implements StringInterface
{
    const COLON         = ':';
    const FORWARD_SLASH = '/';
    const QUESTION_MARK = '?';

    /**
     * @var string
     */
    private $value;

    private $port;

    private $path;

    private $query;

    private $scheme;

    private $host;

    /**
     * Url constructor.
     * @param $value string
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->extractUrlParts($value);

        if (!filter_var($value, FILTER_VALIDATE_URL) === false) {
            $this->value = $value;
        } else {
            throw new InvalidUrlException($value);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param $values
     * @return \G4\ValueObject\Url
     */
    public function path($values)
    {
        $this->path = self::FORWARD_SLASH . join(self::FORWARD_SLASH, $values);

        return new self($this->buildUrl());
    }

    /**
     * @param $value
     * @return \G4\ValueObject\Url
     */
    public function port($value)
    {
        $this->port = self::COLON . $value;

        return new self($this->buildUrl());
    }

    /**
     * @param array $values
     * @return \G4\ValueObject\Url
     */
    public function query(array $values)
    {
        $this->query = self::QUESTION_MARK. http_build_query($values);

        return new self($this->buildUrl());
    }

    /**
     * @return string
     */
    private function buildUrl()
    {
        return $this->scheme . self::COLON . self::FORWARD_SLASH .self::FORWARD_SLASH . $this->host . $this->port . $this->path . $this->query;
    }

    /**
     * @param $value
     */
    private function extractUrlParts($value)
    {
        $urlParts = parse_url($value);

        $this->scheme = isset($urlParts['scheme']) ? $urlParts['scheme'] : '';
        $this->host   = isset($urlParts['host']) ? $urlParts['host'] : '';
        $this->port   = isset($urlParts['port']) ? self::COLON . $urlParts['port'] : '';
        $this->path   = isset($urlParts['path']) ? $urlParts['path'] : '';
        $this->query  = isset($urlParts['query']) ? $urlParts['query'] : '';
    }
}
