<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currency;

use EoneoPay\Currency\Currencies\Aud;
use EoneoPay\Currency\Exceptions\InvalidCurrencyCodeException;
use EoneoPay\Currency\ISO4217;
use PHPUnit\Framework\TestCase;

/**
 * @covers \EoneoPay\Currency\ISO4217
 * @covers \EoneoPay\Currency\Iterator
 */
class ISO4217Test extends TestCase
{
    /**
     * Find currency by alpha or numeric code
     *
     * @return void
     */
    public function testFindCurrencyByCode(): void
    {
        $iso4217 = new ISO4217();

        // Ensure not case sensitive
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(Aud::class, $iso4217->find('AUD'));
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(Aud::class, $iso4217->find('aud'));

        // Search by numeric code
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(Aud::class, (new ISO4217())->find('036'));
    }

    /**
     * Test finding an invalid currency code
     *
     * @return void
     */
    public function testFindInvalidCurrencyCode(): void
    {
        $this->expectException(InvalidCurrencyCodeException::class);

        (new ISO4217())->find('INVALID');
    }

    /**
     * Test supported currencies returns an array containing a known type
     *
     * @return void
     */
    public function testGetSupportedAlphaCodes(): void
    {
        self::assertContains('AUD', (new ISO4217())->getSupportedAlphaCodes());
    }
}
