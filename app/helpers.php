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
