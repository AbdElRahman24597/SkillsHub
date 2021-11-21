<?php

if (!function_exists('web_asset')) {
    function web_asset($path): string
    {
        return asset('assets/web/' . $path);
    }
}

if (!function_exists('dashboard_asset')) {
    function dashboard_asset($path): string
    {
        return asset('assets/dashboard/' . $path);
    }
}

if (!function_exists('uploads')) {
    function uploads($path): string
    {
        return asset('uploads/' . $path);
    }
}
