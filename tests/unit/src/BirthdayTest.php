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
        $wasBorn = \DateTime::createFromFormat("Y", 1980);
        $now = new \DateTime();

        $this->assertEquals(
            $now->diff($wasBorn)->y,
            $this->birthdayFactory($wasBorn->format('Y'), 1, 1)->getAge()
        );
    }

    public function testGet18()
    {
        $this->assertInstanceOf(Birthday::class, Birthday::get18());
    }

    private function birthdayFactory($year, $month, $day)
    {
        return new Birthday($year, $month, $day);
    }
}