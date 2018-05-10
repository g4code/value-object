<?php

namespace G4\ValueObject;

class ArrayList
{
    /**
     * @var array
     */
    private $data;

    /**
     * ArrayList constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $value
     */
    public function add($value)
    {
        $this->data[] = $value;
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
     * @return array
     */
    public function getAll()
    {
        return $this->data;
    }

    /**
     * @param $value
     * @return bool
     */
    public function has($value)
    {
        return in_array($value, $this->data);
    }

    /**
     * @param $value
     * @return ArrayList
     */
    public function remove($value)
    {
        $data   = $this->data;
        $key    = array_search($value, $this->data);

        if ($key !== false) {
            unset($data[$key]);
            $data = array_values($data);
        }
        return new self($data);
    }

    /**
     * @param StringInterface|null $delimiter
     * @return string
     */
    public function toString(StringInterface $delimiter = null)
    {
        if ($delimiter === null) {
            $delimiter = '';
        }
        return join((string) $delimiter, $this->data);
    }
}
