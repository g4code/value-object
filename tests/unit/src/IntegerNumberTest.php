<?php

use G4\ValueObject\IntegerNumber;
use G4\ValueObject\Exception\InvalidIntegerNumberException;

class IntegerNumberTest extends \PHPUnit_Framework_TestCase
{
    private $invalidIntegers = [
        "0",
        "12",
        12.5,
        "12.5",
        null,
        "null",
        true,
        "true",
        false,
        "false",
        " ",
        ""
    ];

    public function testValidInteger()
    {
        $integerNumber = new IntegerNumber(12);
        $this->assertEquals(12, $integerNumber->getValue());
    }

    public function testInvalidInteger()
    {
        foreach($this->invalidIntegers as $invalidInteger) {

            try {
                (new IntegerNumber($invalidInteger))->getValue();
            } catch(\Exception $e) {
                $exceptionMessage = $e->getMessage();
            }

            $expectedMessage = sprintf(InvalidIntegerNumberException::ERROR_MESSAGE, $invalidInteger);

            $this->assertEquals($expectedMessage, $exceptionMessage);
        }
    }
}