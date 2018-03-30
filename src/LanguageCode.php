<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidLanguageCodeException;

class LanguageCode
{

    private $value;

    private $validCodes = [
        'en_EN',
        'en_GB',
        'en_US',
        'de_AT',
        'de_CH',
        'de_DE',
        'da_DK',
        'es_ES',
        'fi_FI',
        'fr_CH',
        'fr_FR',
        'it_CH',
        'it_IT',
        'nb_NO',
        'ro_RO',
        'ru_RU',
        'sr_RS',
        'sr_RS@latin',
        'sv_SE',
    ];

    /**
     * LanguageCode constructor.
     * @param string $value
     * @throws InvalidLanguageCodeException
     */
    public function __construct($value)
    {
        if (!in_array($value, $this->validCodes, true)) {
            throw new InvalidLanguageCodeException($value);
        }
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
