<?php
namespace test186\HuntingBookingModule\Helpers;

/**
* Минуты
*/
abstract class Minutes
{
    const HOUR = 60;

    /**
    * Форматированная строка с часами и минутами
    *
    * @param int $duration - длительность в минутах
    * @param string $format - формат
    *
    * @return string
    */
    public static function getFormatted(int $duration, string $format = '%02d:02d'): string
    {
        return sprintf($format, floor($duration / static::HOUR), $duration % static::HOUR);
    }
}