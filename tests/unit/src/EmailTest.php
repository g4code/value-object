<?php

use G4\ValueObject\Email;

class EmailTest extends PHPUnit_Framework_TestCase
{

    private $validEmails = [
        'email@example.com',
        'firstname.lastname@example.com',
        'email@subdomain.example.com',
        'firstname+lastname@example.com',
        'email@[123.123.123.123]',
        '"email"@example.com',
        '1234567890@example.com',
        'email@example-one.com',
        '_______@example.com',
        'email@example.name',
        'email@example.museum',
        'email@example.co.jp',
        'firstname-lastname@example.com'
    ];

    private $invalidEmails = [
        '',
        'plainaddress',
        '#@%^%#$@#$@#.com',
        '@example.com',
        'Joe Smith <email@example.com>',
        'email.example.com',
        'email@example@example.com',
        '.email@example.com',
        'email.@example.com',
        'email..email@example.com',
        'あいうえお@example.com',
        'email@example.com (Joe Smith)',
        'email@example',
        'email@-example.com',
        'email@example.web',
        'email@111.222.333.44444',
        'email@example..com',
        'Abc..123@example.com',
        'email@123.123.123.123',
    ];

    public function testEmailToString()
    {
        foreach ($this->validEmails as $validEmail) {
            $this->assertEquals($validEmail, (string) new Email($validEmail));
        }
    }

    public function testBadEmail()
    {
        foreach ($this->invalidEmails as $invalidEmail){
            $this->setExpectedException(
                '\Exception',
                \G4\ValueObject\Exception\InvalidEmailException::ERROR_MESSAGE,
                \G4\ValueObject\Exception\InvalidEmailException::ERROR_UUID
            );
            new Email($invalidEmail);
        }
    }
}