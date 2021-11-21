<?php

use App\Models\Setting;

if (!function_exists('navbar')) {
    function navbar($model = '\App\Models\Category'): \Illuminate\Database\Eloquent\Collection
    {
        return $model::select('id', 'name')->active()->get();
    }
}

if (!function_exists('settings')) {
    function settings($settings = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin'])
    {
        return Setting::select($settings)->first();
    }
}
