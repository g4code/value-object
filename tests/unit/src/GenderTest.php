<?php

use G4\ValueObject\Gender;
use G4\ValueObject\Exception\InvalidGenderKeyException;
use G4\ValueObject\Exception\InvalidGenderException;

class GenderTest extends PHPUnit_Framework_TestCase
{
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
        $this->assertEquals(['F', 'C'], $this->genderFactory("M")->getOpposite());
    }

    public function testGetGenderTypeMale()
    {
        $this->assertEquals("Male", $this->genderFactory("M")->getGenderType());
    }

    public function testGetGenderTypeLowercaseMale()
    {
        $this->assertEquals("male", $this->genderFactory("M")->getGenderTypeLowercase());
    }

    public function testGetGenderKeyMale()
    {
        $this->assertEquals("1", $this->genderFactory("M")->getGenderKey());
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
        $this->assertEquals(["M"], $this->genderFactory("F")->getOpposite());
    }

    public function testGetGenderTypeLowercaseFemale()
    {
        $this->assertEquals("female", $this->genderFactory("F")->getGenderTypeLowercase());
    }

    public function testGetGenderKeyFemale()
    {
        $this->assertEquals("2", $this->genderFactory("F")->getGenderKey());
    }

    public function testToStringFemale()
    {
        $this->assertEquals("F", (string)$this->genderFactory("F"));
    }

    //COUPLE

    public function testGetGenderNameCouple()
    {
        $this->assertEquals("Couple", $this->genderFactory("C")->getGenderName());
    }

    public function testGetGenderPluralCouple()
    {
        $this->assertEquals("Couples", $this->genderFactory("C")->getGenderPlural());
    }

    public function testGetGenderTypeCouple()
    {
        $this->assertEquals("Couple", $this->genderFactory("C")->getGenderType());
    }

    public function testGetOppositeOfCouple()
    {
        $this->assertEquals(["M"], $this->genderFactory("C")->getOpposite());
    }

    public function testGetGenderTypeLowercaseCouple()
    {
        $this->assertEquals("couple", $this->genderFactory("C")->getGenderTypeLowercase());
    }

    public function testGetGenderKeyCouple()
    {
        $this->assertEquals("3", $this->genderFactory("C")->getGenderKey());
    }

    public function testToStringCouple()
    {
        $this->assertEquals("C", (string)$this->genderFactory("C"));
    }

    //exceptions

    public function testException()
    {
        $this->expectException(InvalidGenderException::class);
        $this->genderFactory('some_unknowN_@gender!');
    }

    public function testCreateFromKeyException()
    {
        $badKey = 0;
        $this->expectException(InvalidGenderKeyException::class);
        $this->expectExceptionMessage('Gender key 0 is invalid');
        $this->expectExceptionCode(60023);
        Gender::createFromKey($badKey);
    }

    //static methods
    public function testCreateMale()
    {
        $aMale = Gender::createMale();
        $this->assertInstanceOf(Gender::class, Gender::createMale());
        $this->assertEquals("M", (string)$aMale);
    }

    public function testCreateFemale()
    {
        $aFemale = Gender::createFemale();
        $this->assertInstanceOf(Gender::class, Gender::createFemale());
        $this->assertEquals("F", (string)$aFemale);
    }

    public function testCreateCouple()
    {
        $aCouple = Gender::createCouple();
        $this->assertInstanceOf(Gender::class, Gender::createCouple());
        $this->assertEquals("C", (string) $aCouple);
    }

    public function testCreateFromKey()
    {
        $this->assertEquals('M', (string)Gender::createFromKey(1));
        $this->assertEquals('M', (string)Gender::createFromKey('1'));

        $this->assertEquals('F', (string)Gender::createFromKey(2));
        $this->assertEquals('F', (string)Gender::createFromKey('2'));

        $this->assertEquals('C', (string)Gender::createFromKey(3));
        $this->assertEquals('C', (string)Gender::createFromKey('3'));
    }

    /**
     * @dataProvider genderOppositeDataProvider
     *
     * @param $value
     * @param array $opposites
     */
    public function testGetOpposite($value, array $opposites)
    {
        $gender = new Gender($value);

        $result = $gender->getOpposite();

        $this->assertEquals($result, $opposites);
    }

    public function genderOppositeDataProvider()
    {
        return [
            ['F', ['M']],
            ['C', ['M']],
            ['M', ['F', 'C']],
        ];
    }

    /**
     * @dataProvider genderOppositeTypesLowercaseDataProvider
     *
     * @param $value
     * @param array $oppositeTypesLowercase
     */
    public function testGetGenderOppositeTypesLowercase($value, array $oppositeTypesLowercase)
    {
        $gender = new Gender($value);

        $result = $gender->getGenderOppositeTypesLowercase();

        $this->assertEquals($result, $oppositeTypesLowercase);
    }

    public function genderOppositeTypesLowercaseDataProvider()
    {
        return [
            ['F', ['male']],
            ['C', ['male']],
            ['M', ['female', 'couple']],
        ];
    }

    /**
     * @dataProvider genderOppositeKeysDataProvider
     *
     * @param $value
     * @param array $oppositeKeys
     */
    public function testGetGenderOppositeKeys($value, array $oppositeKeys)
    {
        $gender = new Gender($value);

        $result = $gender->getOppositeGenderKeys();

        $this->assertEquals($result, $oppositeKeys);
    }

    public function genderOppositeKeysDataProvider()
    {
        return [
            ['F', [1]],
            ['C', [1]],
            ['M', [2, 3]],
        ];
    }

    private function genderFactory($gender)
    {
        return new Gender($gender);
    }
}