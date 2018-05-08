<?php

namespace G4\ValueObject;

class ArrayList
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
     * @param $key
     * @return ArrayList
     */
    public function remove($key)
    {
        if (array_key_exists($key, $this->data)) {
            unset($this->data[$key]);
        }

        return new self($this->data);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @return integer
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @param ArrayList $data
     * @return bool
     */
    public function equals(ArrayList $data)
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
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->data);
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
}
