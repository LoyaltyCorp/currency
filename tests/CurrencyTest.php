<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies;

use EoneoPay\Currencies\Interfaces\CurrencyInterface;
use PHPUnit\Framework\TestCase;
use Tests\EoneoPay\Currencies\Stubs\CurrencyStub;

/**
 * @covers \EoneoPay\Currencies\Currency
 */
class CurrencyTest extends TestCase
{
    /**
     * Invoke a currency and test functionality
     *
     * @return void
     */
    public function testCurrencyStandardFunctionality(): void
    {
        $currency = new CurrencyStub();

        self::assertInstanceOf(CurrencyInterface::class, $currency);
        self::assertSame('CURRENCYSTUB', $currency->getAlphaCode());
        self::assertSame("\u{1d530}", $currency->getCurrencySymbol());
        self::assertSame(10, $currency->getMinorUnit());
        self::assertSame('Dollarydoo', $currency->getName());
        self::assertSame('123', $currency->getNumericCode());
    }
}
