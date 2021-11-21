<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['newMessages'] = Message::where('replied', false)->get()->count();

        return view('dashboard.home.index')->with($data);
    }
}
