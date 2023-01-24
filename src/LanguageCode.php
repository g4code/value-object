<?php

namespace G4\ValueObject;

use G4\ValueObject\Exception\InvalidLanguageCodeException;

class LanguageCode
{

    /**
     * @var string
     */
    private $value;

    const DA_DK       = 'da_DK';
    const DE_AT       = 'de_AT';
    const DE_CH       = 'de_CH';
    const DE_DE       = 'de_DE';
    const EN_EN       = 'en_EN';
    const EN_GB       = 'en_GB';
    const EN_US       = 'en_US';
    const ES_ES       = 'es_ES';
    const FI_FI       = 'fi_FI';
    const FR_CH       = 'fr_CH';
    const FR_FR       = 'fr_FR';
    const IT_CH       = 'it_CH';
    const IT_IT       = 'it_IT';
    const KO_KR       = 'ko_KR';
    const NB_NO       = 'nb_NO';
    const NL_NL       = 'nl_NL';
    const PT_PT       = 'pt_PT';
    const RO_RO       = 'ro_RO';
    const RU_RU       = 'ru_RU';
    const SL_SI       = 'sl_SI';
    const SR_RS       = 'sr_RS';
    const SR_RS_LATIN = 'sr_RS@latin';
    const SV_SE       = 'sv_SE';
    const TR_TR       = 'tr_TR';
    const ZH_TW       = 'zh_TW';

    private $validCodes = [
        self::DA_DK,
        self::DE_AT,
        self::DE_CH,
        self::DE_DE,
        self::EN_EN,
        self::EN_GB,
        self::EN_US,
        self::ES_ES,
        self::FI_FI,
        self::FR_CH,
        self::FR_FR,
        self::IT_CH,
        self::IT_IT,
        self::KO_KR,
        self::NB_NO,
        self::NL_NL,
        self::PT_PT,
        self::RO_RO,
        self::RU_RU,
        self::SL_SI,
        self::SR_RS,
        self::SR_RS_LATIN,
        self::SV_SE,
        self::TR_TR,
        self::ZH_TW
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @param LanguageCode $value
     * @return bool
     */
    public function equals(LanguageCode $value)
    {
        return $this->value === $value->__toString();
    }
}
