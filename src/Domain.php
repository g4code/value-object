<?php

namespace G4\ValueObject;

class Domain
{

    /**
     * @var string
     */
    private $value;

    /**
     * Email constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        //TODO consider domain validation
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

}