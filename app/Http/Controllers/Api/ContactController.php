<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function store(): Response
    {
        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:10000',
        ]);

        Message::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'subject' => $attributes['subject'],
            'body' => $attributes['message'],
        ]);

        return response()->noContent();
    }
}
