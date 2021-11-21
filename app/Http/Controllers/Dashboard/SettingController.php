<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data['setting'] = Setting::first();

        return view('dashboard.settings.index')->with($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'facebook' => 'required|url|max:255',
            'twitter' => 'required|url|max:255',
            'instagram' => 'required|url|max:255',
            'youtube' => 'required|url|max:255',
            'linkedin' => 'required|url|max:255',
        ]);

        Setting::first()->update($data);

        return back()->with('success', 'Settings updated successfully.');
    }
}
