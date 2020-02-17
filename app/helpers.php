<?php

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
