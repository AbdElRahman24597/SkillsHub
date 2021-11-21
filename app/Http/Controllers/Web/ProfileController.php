<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = auth()->user();

        return view('web.profile.index')->with($data);
    }

    public function show(User $user)
    {
        $data['user'] = $user;

        return view('web.profile.show')->with($data);
    }

    public function edit()
    {
        $data['user'] = auth()->user();

        return view('web.profile.edit')->with($data);
    }

    public function changePassword()
    {
        $data['user'] = auth()->user();

        return view('web.profile.change-password')->with($data);
    }

    public function scoreboard()
    {
        return view('web.profile.scoreboard');
    }
}
