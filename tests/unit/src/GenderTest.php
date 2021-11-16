<?php

use G4\ValueObject\Gender;
use G4\ValueObject\Exception\InvalidGenderKeyException;
use G4\ValueObject\Exception\InvalidGenderException;

class GenderTest extends PHPUnit_Framework_TestCase {


    //MALE

    public function testGetGenderNameMale()
    {
        $this->assertEquals("Man", $this->genderFactory("M")->getGenderName());
    }

    public function testGetGenderPluralMale()
    {
        $this->assertEquals("Men", $this->genderFactory("M")->getGenderPlural());
    }

    public function testGetOppositeOfMale()
    {
        $this->assertEquals("F", $this->genderFactory("M")->getOpposite());
    }

    public function testGetGenderTypeMale()
    {
        $this->assertEquals("Male", $this->genderFactory("M")->getGenderType());
    }

    public function testGetGenderTypeLowercaseMale()
    {
        $this->assertEquals("male", $this->genderFactory("M")->getGenderTypeLowercase());
    }

    public function testGetGenderOppositeTypeLowercaseMale()
    {
        $this->assertEquals("female", $this->genderFactory("M")->getGenderOppositeTypeLowercase());
    }

    public function testGetGenderKeyMale()
    {
        $this->assertEquals("1", $this->genderFactory("M")->getGenderKey());
    }

    public function testGetOppositeGenderKeyMale()
    {
        $this->assertEquals("2", $this->genderFactory("M")->getOppositeGenderKey());
    }

    public function testToStringMale()
    {
        $this->assertEquals("M", (string)$this->genderFactory("M"));
        $this->assertEquals("M", $this->genderFactory("M")->getGender());
    }


    //FEMALE

    public function testGetGenderNameFemale()
    {
        $this->assertEquals("Woman", $this->genderFactory("F")->getGenderName());
    }

    public function testGetGenderPluralFemale()
    {
        $this->assertEquals("Women", $this->genderFactory("F")->getGenderPlural());
    }

    public function testGetGenderTypeFemale()
    {
        $this->assertEquals("Female", $this->genderFactory("F")->getGenderType());
    }

    public function testGetOppositeOfFemale()
    {
        $this->assertEquals("M", $this->genderFactory("F")->getOpposite());
    }

    public function testGetGenderTypeLowercaseFemale()
    {
        $this->assertEquals("female", $this->genderFactory("F")->getGenderTypeLowercase());
    }

    public function testGetGenderOppositeTypeLowercaseFemale()
    {
        $this->assertEquals("male", $this->genderFactory("F")->getGenderOppositeTypeLowercase());
    }

    public function testGetGenderKeyFemale()
    {
        $this->assertEquals("2", $this->genderFactory("F")->getGenderKey());
    }

    public function testGetOppositeGenderKeyFemale()
    {
        $this->assertEquals("1", $this->genderFactory("F")->getOppositeGenderKey());
    }

    public function testToStringFemale()
    {
        $this->assertEquals("F", (string)$this->genderFactory("F"));
    }

    //exceptions

    public function testException()
    {
        $this->expectException(InvalidGenderException::class);
        $this->genderFactory('some_unknowN_@gender!');
    }

    public function testOpositeMaleToFemale()
    {
        $aMale      = Gender::createMale();
        $aFemale    = $aMale->createOpposite();
        $this->assertInstanceOf(Gender::class, $aFemale);
        $this->assertEquals('F', (string) $aFemale);
    }

    public function testOpositeFemaleToMale()
    {
        $aFemale    = Gender::createFemale();
        $aMale      = $aFemale->createOpposite();
        $this->assertInstanceOf(Gender::class, $aMale);
        $this->assertEquals('M', (string) $aMale);
    }

    //static methods
    public function testCreateMale()
    {
        $aMale = Gender::createMale();
        $this->assertInstanceOf(Gender::class, $aMale);
        $this->assertEquals("M", (string)$aMale);
    }

    public function testCreateFemale()
    {
        $aFemale = Gender::createFemale();
        $this->assertInstanceOf(Gender::class, $aFemale);
        $this->assertEquals("F", (string)$aFemale);
    }

    public function testCreateFromKey()
    {
        $this->assertEquals('M', (string)Gender::createFromKey(1));
        $this->assertEquals('M', (string)Gender::createFromKey('1'));

        $this->assertEquals('F', (string)Gender::createFromKey(2));
        $this->assertEquals('F', (string)Gender::createFromKey('2'));
    }

    public function testCreateFromKeyException()
    {
        $badKey = 0;
        $this->expectException(InvalidGenderKeyException::class);
        $this->expectExceptionMessage('Gender key 0 is invalid');
        $this->expectExceptionCode(60023);
        Gender::createFromKey($badKey);
    }

    private function genderFactory($gender)
    {
        return new Gender($gender);
    }
}