<?php

use G4\ValueObject\Birthday;

class BirthdayTest extends PHPUnit_Framework_TestCase {


    public function testGetBirthday()
    {
        $aBirthday = $this->birthdayFactory(2011,1,1)->getBirthday();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory(2011,0,0)->getBirthday();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory('2011','1','1')->getBirthday();
        $this->assertEquals(
            '2011-01-01',
            $aBirthday->format('Y-m-d')
        );

        $aBirthday = $this->birthdayFactory('2003','07','16')->getBirthday();
        $this->assertEquals(
            '2003-07-16',
            $aBirthday->format('Y-m-d')
        );
    }

    public function testExceptionInFuture()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidBirthdayException::class);
        $this->birthdayFactory('2020','30','2')->getBirthday();
    }

    public function testExceptionElfs()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidBirthdayException::class);
        $this->birthdayFactory('1855','30','2')->getBirthday();
    }

    public function testGetAge()
    {
        $now = new \DateTime();

        $birthday = $this->birthdayFactory(1981, 12, 18);

        $this->assertEquals(
            $now->diff($birthday->getBirthday())->y,
            $birthday->getAge()
        );
    }

    public function testGet18()
    {
        $this->assertInstanceOf(Birthday::class, Birthday::get18());
    }

    public function testFormat()
    {
        $aDate = $this->birthdayFactory('1961','3','30')->format();
        $this->assertEquals('1961-03-30', $aDate);
    }

    private function birthdayFactory($year, $month, $day)
    {
        return new Birthday($year, $month, $day);
    }

    public function testMakeFromString()
    {
        $birthdayString = '1986-10-19';
        $birthday       = Birthday::makeFromString($birthdayString);
        
        $this->assertInstanceOf(Birthday::class, $birthday);
        $this->assertEquals($birthdayString, $birthday->format());
    }
}
