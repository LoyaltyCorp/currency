<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use EoneoPay\Currencies\Exceptions\InvalidLocaleIdentifierException;
use EoneoPay\Currencies\Interfaces\LocaleInterface;
use EoneoPay\Currencies\Interfaces\TranslatorInterface;
use EoneoPay\Currencies\Locales\ArOm;
use EoneoPay\Currencies\Locales\EnAu;
use EoneoPay\Currencies\Locales\FrFr;
use EoneoPay\Currencies\Locales\JaJp;
use EoneoPay\Currencies\Locales\NlNl;
use EoneoPay\Currencies\Locales\ZhCn;

class Translator implements TranslatorInterface
{
    /** @var string[] */
    private static $locales = [
        'ar-om' => ArOm::class,
        'en-au' => EnAu::class,
        'fr-fr' => FrFr::class,
        'ja-jp' => JaJp::class,
        'nl-nl' => NlNl::class,
        'zh-cn' => ZhCn::class
    ];

    /**
     * @inheritdoc
     */
    public function find(string $identifier): LocaleInterface
    {
        // Format identifier
        $identifier = \mb_strtolower(\sprintf(
            '%s-%s',
            \substr(\preg_replace('/[^a-zA-Z]+/', '', $identifier), 0, 2),
            \substr(\preg_replace('/[^a-zA-Z]+/', '', $identifier), -2)
        ));

        if (isset(static::$locales[$identifier])) {
            $locale = static::$locales[$identifier];

            return new $locale();
        }

        // Locale isn't found, throw exception
        throw new InvalidLocaleIdentifierException(
            \sprintf('Locale identifier can not be found: %s', \mb_strtoupper($identifier))
        );
    }

    /**
     * @inheritdoc
     */
    public function getSupportedLocales(): array
    {
        $localeCodes = [];

        foreach (static::$locales as $locale) {
            $localeCodes[] = (new $locale())->getIdentifier();
        }

        return $localeCodes;
    }
}
