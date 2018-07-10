<?php

namespace G4\ValueObject;

class Dictionary
{

    /**
     * @var array
     */
    private $data;

    /**
     * Dictionary constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param array ...$keys
     * @return Dictionary
     */
    public function remove(...$keys)
    {
        count($keys) > 1
            ?   array_map(function ($key) {
                    $this->removeKey($key);
            }, $keys)
            :   $this->removeKey(reset($keys));

        return new self($this->data);
    }

    /**
     * @return integer
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @param Dictionary $data
     * @return bool
     */
    public function equals(Dictionary $data)
    {
        return $this->data === $data->getAll();
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
     * @param $key
     * @return bool
     */
    public function hasNonEmptyValue($key)
    {
        return $this->has($key) && !empty($this->data[$key]);
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasNotNullValue($key)
    {
        return $this->has($key) && $this->data[$key] !== null;
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
        return !empty(array_filter($keys, function ($key) {
            return $this->has($key);
        }));
    }

    /**
     * @param $key
     * @return Dictionary
     */
    public function slice($key)
    {
        return new self($this->get($key));
    }

    /**
     * @param Dictionary $data
     * @return Dictionary
     */
    public function merge(Dictionary $data)
    {
        return new self(
            array_merge($this->getAll(), $data->getAll())
        );
    }

    /**
     * @param StringInterface|null $delimiter
     * @return string
     */
    public function toString(StringInterface $delimiter = null)
    {
        if ($delimiter === null) {
            return join("", $this->data);
        }
        return join((string) $delimiter, $this->data);
    }

    /**
     * @param $key
     */
    private function removeKey($key)
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }
    }
}
