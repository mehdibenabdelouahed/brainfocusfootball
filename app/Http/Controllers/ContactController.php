<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Implement email sending logic (e.g., Mail::to(admin)->send(new ContactMail($data)))

        return back()->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons dans les plus brefs délais.');
    }
}
