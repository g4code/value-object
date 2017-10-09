<?php

namespace G4\ValueObject;


class EmailType
{
    const OTHER = 'other';
    const GMAIL = 'gmail';
    const YAHOO = 'yahoo';

    private $value = self::OTHER;

    public function __construct($email)
    {
        if (preg_match('/gmail/', $email)) {
            $this->value = self::GMAIL;
        }

        if (preg_match('/yahoo/', $email)) {
            $this->value = self::YAHOO;
        }
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
