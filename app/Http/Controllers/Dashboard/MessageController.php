<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\MessagesReply;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::orderBy('id', 'DESC')->paginate(10);

        return view('dashboard.messages.index')->with($data);
    }

    public function show(Message $message)
    {
        $data['message'] = $message;

        return view('dashboard.messages.show')->with($data);
    }

    public function reply(Request $request, Message $message)
    {
        if ($message->replied) {
            return back();
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Mail::to($message->email)->send(new MessagesReply($message->name, $request->title, $request->body));

        $message->update([
            'replied' => true,
        ]);

        return redirect()->route('dashboard.messages.index')->with('success', 'Message replied successfully.');
    }
}
