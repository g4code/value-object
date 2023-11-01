<?php

use G4\ValueObject\Currency;

class CurrencyTest extends \PHPUnit\Framework\TestCase
{

    public function testCurrency()
    {
        $aCurrency = new Currency('EUR');
        $this->assertEquals('EUR', $aCurrency->getValue());
        $this->assertEquals('Euro', $aCurrency->getTitle());
        $this->assertEquals('€', $aCurrency->getSymbol());
    }

    public function testException()
    {
        $this->expectException(\G4\ValueObject\Exception\InvalidCurrencyException::class);
        new Currency('drachma');
    }

}