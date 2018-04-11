# Currencies

This library allows currencies to be found by [ISO4217](https://en.wikipedia.org/wiki/ISO_4217) code or numeric identifier and formatted for display based on different locales.

This library comes in three main parts: currencies, locales and a translator.

## Currencies

Currencies are simple files made up of:

| Property | Description |
|----------|-------------|
| Minor unit | The number of decimal places the currency uses, e.g. 2 for Australian Dollar |
| Name | The currency name, e.g. Australian Dollar |
| Numeric code | The ISO4217 numeric code, e.g. 036 for Australian Dollar |
| Symbol   | The UTF-8 currency symbol, e.g. $ |

The currency class name is the ISO4217 alpha code in PSR-2 format, e.g. `Aud` for Australian Dollar.

### Finding a currency

You can find a currency using the `ISO4217` class. This class provides two methods:

| Method | Description |
|--------|-------------|
| `find($code): CurrencyInterface` | Find a currency by alpha* or numeric code |
| `getSupportedAlphaCodes(): array` | Get a list of supported alpha codes |

<sup>* Alpha code is case insensitive</sup>

**Note:** Not all currencies are currently supported, more currencies will be added as soon as possible, optionally you can open a pull request to add currencies you require.

### Working with a currency

If a currency is successfully found you will recieve a currency object back with the following methods:

| Method | Description |
|----------|-------------|
| `getAlphaCode(): string` | Get the alpha code for the currency |
| `getMinorUnit(): int` | Get the number of decimal places the currency uses |
| `getName(): string` | Get full name for the currency |
| `getNumericCode(): string` | Get the ISO4217 numeric code for the currency |
| `getCurrencySymbol(): string`   | Get the UTF-8 symbol for the currency |

## Locales

Locales are also simple files made up of:

| Property | Description |
|----------|-------------|
| Identifier | The IETF language tag of the locale, e.g. en-AU for Australian English |
| Currency format | How to format a currency using symbol replacement, e.g. '-¤ #' for Australian English |
| Decimal separator | How decimals are represented in numeric displays, e.g. period for Australian English |
| Negative symbol | The negative symbol used by this locale, e.g. hyphen for Austrlaian English |
| Numeric format | How to format a numeric value using symbol replacement, e.g. '-#' for Australian English |
| Thousands separator | The separator used to group thousands together, e.g. comma for Australian English |

### Why not php-intl?

This code seems to duplicate what php-intl provides with the [NumberFormatter class](http://php.net/manual/en/class.numberformatter.php) however this extension works differently on different operating systems and locales which causes formatted numbers and currencies to be inconsistent. The [symfony/intl](http://symfony.com/doc/current/components/intl.html) package only provides support for en-US or falls back to `php-intl` if it's installed which causes the same issues. 

This library provides consistenty across all operating systems independently of `php-intl` when it comes to formatting numbers or currencies for display.

### Finding a locale

You can find a currency using the `Translator` class. This class provides two methods:

| Method | Description |
|--------|-------------|
| `find($code): LocaleInterface` | Find a locale by IETF language code* |
| `getSupportedLocales(): array` | Get a list of supported IETF language codes |

<sup>* IETF is case insensitive and ignores special characters: en-au, en_AU, enAu and en((au will all resolve correctly</sup>

**Note:** Not all locales are currently supported, more locales will be added as soon as possible, optionally you can open a pull request to add locales you require.

### Working with a locale

If a locale is successfully found you will recieve a locale object back with the following method:

| Method | Description |
|----------|-------------|
| `getIdentifier(): string` | Get the IETF language code for the current locale |

## Formatting

The real use of this class is to format numbers and currencies based on locale, this is done via for `Formatter` class which provides four methods:

| Method | Description |
|--------|-------------|
| `currency(string $locale): string` | Get the amount formatted using the precision and symbol from the currency displayed based on an IETF locale language code |
| `decimal(): string` | Get the amount formatted using the precision from the currency, e.g. 2 decimal places for Australian Dollar |
| `numeric(string $locale): string` | Get the amount formatted using the precision from the currency displayed based on an IETF locale language code |

When instantiating the formatter an amount and ISO4217 alpha or numeric code must be passed to the constructor.

```
/**
 * Format a currency based on locale
 */

// Create formatter based on bitcoin with negative value
$formatter = new \EoneoPay\Currencies\Formatter('-1.051', 'xbt');

// Australia
echo $formatter->currency('en-AU'); // -฿1,601.05100000

// China
echo $formatter->currency('zh-CN'); // -฿ 1601.05100000

// France
echo $formatter->currency('fr-FR'); // -1 601,05100000 ฿

// Netherlands
echo $formatter->currency('nl-NL'); // ฿ -1.601,05100000

// Oman
echo $formatter->currency('ar-OM'); // ؜฿ ؜-١٬٦٠١٫٠٥١٠٠٠٠٠

```
```
/**
 * Format a number based on locale
 */
 
// Create formatter based on bitcoin with positive value
$formatter = new \EoneoPay\Currencies\Formatter('1.051', 'xbt');

// Australia
echo $formatter->numeric('en-AU'); // 1,601.05100000

// China
echo $formatter->numeric('zh-CN'); // 1601.05100000

// France
echo $formatter->numeric('fr-FR'); // 1 601,05100000

// Netherlands
echo $formatter->numeric('nl-NL'); // 1.601,05100000

// Oman
echo $formatter->numeric('ar-OM'); // ؜١٬٦٠١٫٠٥١٠٠٠٠٠
```

**Note:** Arabic may not be displayed correctly due to RTL formatting of the output.