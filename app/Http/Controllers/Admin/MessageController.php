<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->status = 'Read';
        $message->save();

        return view('admin.messages.show', compact('message'));
    }
}
