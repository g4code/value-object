<?php

use G4\ValueObject\GACode;

use G4\ValueObject\Exception\InvalidGaCodeException;

class GACodeTest extends \PHPUnit\Framework\TestCase
{
    public function testWithValidValues()
    {
        $gaCode = new GACode('UA-87667025-89');
        $this->assertEquals('UA-87667025-89', (string) $gaCode);

        $gaCode = new GACode('ua-87667025-89');
        $this->assertEquals('ua-87667025-89', (string) $gaCode);

        $gaCode = new GACode('UA-8766-89');
        $this->assertEquals('UA-8766-89', (string) $gaCode);

        $gaCode = new GACode('UA-8766-8957');
        $this->assertEquals('UA-8766-8957', (string) $gaCode);
    }

    public function testInvalidValuesFirstCase()
    {
        $this->expectException(InvalidGaCodeException::class);
        new GACode('U-8766-8957');
    }

    public function testInvalidValuesSecondCase()
    {
        $this->expectException(InvalidGaCodeException::class);
        new GACode('UA-876-8957');
    }

    public function testInvalidValuesThirdCase()
    {
        $this->expectException(InvalidGaCodeException::class);
        new GACode('UA-8768-88998');
    }
}