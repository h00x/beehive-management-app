<?php

use Lawnstarter\LaravelDarkSky\Facades\DarkSky;
use Spatie\Geocoder\Facades\Geocoder;

if (! function_exists('parseDateForInput')) {
    /**
     * Returns the date formatted for HTML date input fields
     *
     * @param $date
     * @param string $format
     * @return string
     */
    function parseDateForInput($date, $format = 'Y-m-d\TH:i') {
        return Carbon\Carbon::parse($date)->format($format);
    }
}

if (! function_exists('dateNowForInput')) {
    /**
     * Returns the date of now formatted for HTML date input fields
     *
     * @param string $format
     * @return string
     */
    function dateNowForInput($format = 'Y-m-d\TH:i') {
        return Carbon\Carbon::now()->format($format);
    }
}

if (! function_exists('checkIdForSelected')) {
    /**
     * @param Int $toCheckId
     * @param mixed ...$idsArray
     * @return string
     */
    function checkIdForSelected($toCheckId, ...$idsArray) {
        foreach ($idsArray as $id) {
            if ($id == $toCheckId) {
                return 'selected';
            }
        }

        return '';
    }
}

if (! function_exists('isCurrentRoute')) {
    function isCurrentRoute($route) {
        return \Illuminate\Support\Facades\Route::is($route);
    }
}

if (! function_exists('setPreviousUrl')) {
    /**
     * Sets the previous url in url.intended session and ignores it if there are errors in the session
     */
    function setPreviousUrl() {
        if (!session()->get('errors') && url()->current() !== url()->previous()) {
            session()->put('url.intended', url()->previous());
        }
    }
}

if (! function_exists('getWeather')) {
    /**
     * Input any location and the weather is returned. Returns null if the location is not found.
     *
     * @param $location
     * @return array|null
     */
    function getWeather($location) {
        $geocode = Geocoder::getCoordinatesForAddress($location);

        if ($geocode['formatted_address'] !== 'result_not_found') {
            return DarkSky::location($geocode['lat'], $geocode['lng'])->excludes(['flags', 'hourly', 'minutely', 'daily', 'offset'])->units('si')->get();
        }

        return null;
    }
}
