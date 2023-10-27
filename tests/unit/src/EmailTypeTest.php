<?php

use G4\ValueObject\EmailType;

class EmailTypeTest extends \PHPUnit\Framework\TestCase
{
    const OTHER = 'other';
    const GMAIL = 'gmail';
    const YAHOO = 'yahoo';

    public function testToStringOther()
    {
        $this->assertEquals(
            self::OTHER,
            $this->emailTypeFactory()
        );
    }

    public function testToStringGmail()
    {
        $this->assertEquals(
            self::GMAIL,
            $this->emailTypeFactory('user@gmail.com')
        );
    }

    public function testToStringYahoo()
    {
        $this->assertEquals(
            self::YAHOO,
            $this->emailTypeFactory('user@yahoo.com')
        );
    }

    private function emailTypeFactory($value = 'user@specialDomain.com')
    {
        return new EmailType($value);
    }
}
