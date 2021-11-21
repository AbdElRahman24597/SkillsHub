<?php

if (!function_exists('convert_date')) {
    function convert_date(string $date, string $format = 'd M, Y'): string
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}
