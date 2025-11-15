<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('contact.form');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Message::create($request->validated() + ['submitted_at' => now()]);

        return redirect()->route('contact.form')->with('status', 'Köszönjük, az üzenetet rögzítettük!');
    }
}
