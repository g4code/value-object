<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidHttpMethodException;
use G4\ValueObject\Exception\MissingHttpMethodValueException;

class HttpMethod
{
    const METHOD_GET        = 'GET';
    const METHOD_INDEX      = 'INDEX';
    const METHOD_HEAD       = 'HEAD';
    const METHOD_POST       = 'POST';
    const METHOD_PUT        = 'PUT';
    const METHOD_DELETE     = 'DELETE';
    const METHOD_CONNECT    = 'CONNECT';
    const METHOD_OPTIONS    = 'OPTIONS';
    const METHOD_TRACE      = 'TRACE';
    const METHOD_PATCH      = 'PATCH';

    /**
     * @var string
     */
    private $value;

    /**
     * HttpMethod constructor.
     * @param $value
     * @throws MissingHttpMethodValueException
     * @throws InvalidHttpMethodException
     */
    public function __construct($value)
    {
        if (empty($value)) {
            throw new MissingHttpMethodValueException();
        }

        if (!in_array($value, self::validValues())) {
            throw new InvalidHttpMethodException($value);
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
     * @param HttpMethod $value
     * @return bool
     */
    public function equals(HttpMethod $value)
    {
        return $this->value === $value->__toString();
    }

    /**
     * @return array
     */
    public static function validValues()
    {
        return [
            self::METHOD_GET,
            self::METHOD_INDEX,
            self::METHOD_HEAD,
            self::METHOD_POST,
            self::METHOD_PUT,
            self::METHOD_DELETE,
            self::METHOD_CONNECT,
            self::METHOD_OPTIONS,
            self::METHOD_TRACE,
            self::METHOD_PATCH,
        ];
    }
}
