<?php


namespace App\Helpers;


use phpDocumentor\Reflection\Types\Boolean;

class UnitSystemHelper extends Helper
{
    /**
     * Returns temperature based on the  with the symbol added after the value
     *
     * @param float|null $temperatureInCelsius
     * @param bool $metric
     * @return string
     */
    public static function processTemperatureFromCelsius(?float $temperatureInCelsius, bool $metric):string
    {
        if(!isset($temperatureInCelsius)) return '';

        if($metric) {
            return $temperatureInCelsius . '°C';
        }

        return static::calculateFahrenheit($temperatureInCelsius) . '°F';
    }

    public static function processWeightFromKg(float $weightInKg, bool $metric):string
    {
        if($metric) {
            return round($weightInKg, 2) . ' kg';
        }

        return round(static::calculateLbs($weightInKg), 2) . ' lbs';
    }

    /**
     * Input celsius and get fahrenheit returned
     *
     * @param float $temperatureInCelsius
     * @return float
     */
    public static function calculateFahrenheit(float $temperatureInCelsius):float
    {
        return ($temperatureInCelsius * 1.8) + 32;
    }

    /**
     * Input fahrenheit and get celsius returned
     *
     * @param float $temperatureInFahrenheit
     * @return float
     */
    public static function calculateCelsius(float $temperatureInFahrenheit):float
    {
        return ($temperatureInFahrenheit - 32) * .5556;
    }

    /**
     * Input kilograms and get lbs returned
     *
     * @param float $weightInKg
     * @return float
     */
    public static function calculateLbs(float $weightInKg):float
    {
        return $weightInKg * 2.2046;
    }

    /**
     * Input Lbs and get kg returned
     *
     * @param int $weightInLbs
     * @return int
     */
    public static function calculateKg(float $weightInLbs):float
    {
        return $weightInLbs / 2.2046;
    }
}
