<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function set($locale)
    {
        $acceptedLocales = ['en', 'ar'];
        if (!in_array($locale, $acceptedLocales)) {
            $locale = config('app.locale');
        }
        session()->put('locale', $locale);

        return back();
    }
}
