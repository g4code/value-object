<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidDictionaryException;

class Dictionary
{

    /**
     * @var array
     */
    private $data;

    /**
     * Dictionary constructor.
     * @param array $data
     * @throws InvalidDictionaryException
     */
    public function __construct(array $data)
    {
        if (empty($data)) {
            throw new InvalidDictionaryException($data);
        }

        $this->data = $data;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key)
            ? $this->data[$key]
            : null;
    }

    /**
     * @param array ...$keys
     * @return array|mixed|null
     */
    public function getFromDeeperLevels(...$keys)
    {
        $data = $this->data;
        foreach ($keys as $keyIndex => $aKey) {
            if (is_array($data) && array_key_exists($aKey, $data)) {
                $data = $data[$aKey];
            } else {
                $data = null;
                break;
            }
        }
        return $data;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param array ...$keys
     * @return bool
     */
    public function hasInDeeperLevels(...$keys)
    {
        $data = $this->data;
        $has = false;
        foreach ($keys as $aKey) {
            if (is_array($data) && array_key_exists($aKey, $data)) {
                $data = $data[$aKey];
                $has = true;
            } else {
                $has = false;
                break;
            }
        }
        return $has;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @param $keys
     * @return bool
     */
    public function hasKeys($keys)
    {
        return !empty(array_filter($keys, function($key) {
            return $this->has($key);
        }));
    }


}