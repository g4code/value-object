<?php

use G4\ValueObject\Probability;
use G4\ValueObject\Exception\InvalidProbabilityException;
use G4\ValueObject\Exception\InvalidProbabilityOutcomeException;
use G4\ValueObject\Dictionary;

class ProbabilityTest extends \PHPUnit\Framework\TestCase
{

    public function testGetValue()
    {

        $this->assertEquals(99, (new Probability(99))->getValue());
        $this->assertEquals(2, (new Probability('2'))->getValue());

    }

    public function testBoundaries()
    {
        $this->assertEquals(0, (new Probability(0))->getValue());
        $this->assertEquals(100, (new Probability(100))->getValue());
    }

    public function testAcrossBoundariesLOW()
    {
        $this->expectException(InvalidProbabilityException::class);
        $this->expectExceptionMessage('Probability is not valid: -1');
        $this->expectExceptionCode(60024);
        (new Probability(-1));
    }

    public function testAcrossBoundariesHIGH()
    {
        $this->expectException(InvalidProbabilityException::class);
        $this->expectExceptionMessage('Probability is not valid: 101');
        $this->expectExceptionCode(60024);
        (new Probability(101));
    }

    public function testGenerateRandom()
    {
        $this->assertInstanceOf(Probability::class, Probability::generateRandomWithChance());
    }

    public function testGetOutcome()
    {
        $possibilities = new Dictionary([
            0 => 5,     //5% for zero
            1 => 30,    //30% for 1
            2 => 10,    //10% for 2
            3 => 40,    //40% for 3
            4 => 15     //15% for 4
        ]);
        $this->assertEquals(0, (new Probability(1))->getOutcome($possibilities));
        $this->assertEquals(0, (new Probability(2))->getOutcome($possibilities));
        $this->assertEquals(0, (new Probability(3))->getOutcome($possibilities));
        $this->assertEquals(0, (new Probability(4))->getOutcome($possibilities));
        $this->assertEquals(0, (new Probability(5))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(6))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(7))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(8))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(9))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(10))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(11))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(12))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(13))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(14))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(15))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(16))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(17))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(18))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(19))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(20))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(21))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(22))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(23))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(24))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(25))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(26))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(27))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(28))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(29))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(30))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(31))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(32))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(33))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(34))->getOutcome($possibilities));
        $this->assertEquals(1, (new Probability(35))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(36))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(37))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(38))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(39))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(40))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(41))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(42))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(43))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(44))->getOutcome($possibilities));
        $this->assertEquals(2, (new Probability(45))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(46))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(47))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(48))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(49))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(50))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(51))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(52))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(53))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(54))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(55))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(56))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(57))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(58))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(59))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(60))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(61))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(62))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(63))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(64))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(65))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(66))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(67))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(68))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(69))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(70))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(71))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(72))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(73))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(74))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(75))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(76))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(77))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(78))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(79))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(80))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(81))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(82))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(83))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(84))->getOutcome($possibilities));
        $this->assertEquals(3, (new Probability(85))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(86))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(87))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(88))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(89))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(90))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(91))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(92))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(93))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(94))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(95))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(96))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(97))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(98))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(99))->getOutcome($possibilities));
        $this->assertEquals(4, (new Probability(100))->getOutcome($possibilities));
    }

    public function testInvalidOutcome()
    {
        $this->expectException(InvalidProbabilityOutcomeException::class);
        $this->expectExceptionMessage('Failed to get outcome from possibilities {"1":-110,"2":-31} with probability 33');
        $this->expectExceptionCode(60025);
        (new Probability(33))->getOutcome(new Dictionary([
            1 => -110,
            2 => -31
        ]));
    }

}
