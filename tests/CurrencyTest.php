<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\CurrencyInterface;
use PHPUnit\Framework\TestCase;
use Tests\EoneoPay\Currency\Stubs\CurrencyStub;

/**
 * @covers \EoneoPay\Currency\Currency
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
        self::assertSame('CurrencyStub', $currency->getAlphaCode());
        self::assertSame("\u{1d530}", $currency->getCurrencySymbol());
        self::assertSame(10, $currency->getMinorUnit());
        self::assertSame('Dollarydoo', $currency->getName());
        self::assertSame('123', $currency->getNumericCode());
    }
}
