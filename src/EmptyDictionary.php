<?php

namespace G4\ValueObject;

class EmptyDictionary implements DictionaryInterface
{
    /**
     * @return array
     */
    public function getAll()
    {
        return [];
    }
}