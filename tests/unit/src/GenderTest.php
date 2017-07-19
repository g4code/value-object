<?php

use G4\ValueObject\Gender;

class GenderTest extends PHPUnit_Framework_TestCase {


    //MALE
    public function testGetGenderMale()
    {
        $this->assertEquals("M", $this->genderFactory("M")->getGender());
    }

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


    //FEMALE
    public function testGetGenderFemale()
    {
        $this->assertEquals("F", $this->genderFactory("F")->getGender());
    }

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

    //exceptions

    public function testException()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidGenderException::class);
        $this->genderFactory('some_unknowN_@gender!');
    }


    //static methods
    public function testCreateMale()
    {
        $aMale = Gender::creteMale();
        $this->assertInstanceOf(Gender::class, Gender::creteMale());
        $this->assertEquals("M", $aMale->getGender());
    }

    public function testCreateFemale()
    {
        $aFemale = Gender::createFemale();
        $this->assertInstanceOf(Gender::class, Gender::createFemale());
        $this->assertEquals("F", $aFemale->getGender());
    }

    private function genderFactory($gender)
    {
        return new Gender($gender);
    }
}