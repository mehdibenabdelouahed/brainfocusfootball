<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Mail\NewsletterWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name'  => ['nullable', 'string', 'max:100'],
        ]);

        // Vérifier si déjà inscrit
        $existing = NewsletterSubscriber::where('email', $validated['email'])->first();

        if ($existing) {
            return back()->with('newsletter_message', 'Tu es déjà inscrit(e) à notre newsletter !');
        }

        // Créer l'abonné
        $subscriber = NewsletterSubscriber::create([
            'email'        => $validated['email'],
            'name'         => $validated['name'] ?? null,
            'confirmed_at' => now(),
        ]);

        // Envoyer l'email de confirmation
        try {
            Mail::to($subscriber->email)->send(new NewsletterWelcome($subscriber));
        } catch (\Exception $e) {
            // Ne pas bloquer l'inscription si l'email échoue
        }

        return back()->with('newsletter_success', true);
    }
}
