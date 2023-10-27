<?php

use G4\ValueObject\Email;
use G4\ValueObject\Exception\InvalidEmailException;
use G4\ValueObject\Exception\MissingEmailValueException;

class EmailTest extends \PHPUnit\Framework\TestCase
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
            $this->expectException(
                '\Exception',
                \G4\ValueObject\Exception\InvalidEmailException::ERROR_MESSAGE,
                \G4\ValueObject\Exception\InvalidEmailException::ERROR_UUID
            );
            new Email($invalidEmail);
        }
    }

    public function testGetWithoutPlusAlias()
    {
        $this->assertEquals('test@gmail.com' , (new Email('test@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+1@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+2@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+56+56@gmail.com'))->getWithoutPlusAlias());
        $this->assertEquals('test@gmail.com' , (new Email('test+56+5@gmail.com'))->getWithoutPlusAlias());
    }

    public function testEmptyEmail()
    {
        $this->expectException(MissingEmailValueException::class);
        (new Email(''));
    }

    public function testSpaceEmail()
    {
        $this->expectException(InvalidEmailException::class);
        (new Email(' '));
    }

    public function testNullEmail()
    {
        $this->expectException(MissingEmailValueException::class);
        (new Email(null));
    }

    public function testEquals()
    {
        $email = new Email('test@test.com');

        $this->assertTrue($email->equals(new Email('test@test.com')));
        $this->assertFalse($email->equals(new Email('tester@test.com')));
    }
}