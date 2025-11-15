<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Contracts\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::orderByDesc('submitted_at')->paginate(15);

        return view('messages.index', compact('messages'));
    }
}
