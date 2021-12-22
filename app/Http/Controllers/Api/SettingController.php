<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingController extends Controller
{
    public function index(): JsonResource
    {
        return SettingResource::make(
            Setting::first()
        );
    }
}
