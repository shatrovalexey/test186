<?php
namespace test186\HuntingBookingModule\Helpers;

/**
* Деньги
*/
abstract class Money
{
    /**
    * @var ?\NumberFormatter $_formatter объект-форматировщик
    */
    protected static ?\NumberFormatter $_formatter = null;

    /**
    * Форматированная строка с указание суммы
    *
    * @param double $value - сумма числом
    * @param string $currency - валюта
    * @param string $locale - локаль
    * @param int $frac - число знаков после запятой
    *
    * @return string
    */
    public static function getFormatted(double $value, string $currency = 'RUB'
        , string $locale = 'ru_RU', int $frac = 2): string
    {
        return static::_getFormatter($locale, $frac)->formatCurrency($value, $currency);
    }

    /**
    * Форматировщик
    *
    * @param string $locale - локаль
    * @param int $frac - число знаков после запятой
    *
    * @return \NumberFormatter
    */    
    protected static function _getFormatter(string $locale, int $frac): \NumberFormatter
    {
        if (!empty(static::$_formatter)) return static::$_formatter;

        static::$_formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        static::$formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, $frac);

        return static::$_formatter;
    }
}