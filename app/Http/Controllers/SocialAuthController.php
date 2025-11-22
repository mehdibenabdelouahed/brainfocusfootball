<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirige vers le provider OAuth
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Gère le callback du provider OAuth
     */
    public function handleProviderCallback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Erreur lors de la connexion avec ' . ucfirst($provider)]);
        }

        // Chercher un compte social existant
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($socialAccount) {
            // Connecter l'utilisateur existant
            Auth::login($socialAccount->user);
            return redirect()->route('home')->with('success', 'Connexion réussie!');
        }

        // Chercher un utilisateur avec le même email
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Créer un nouvel utilisateur
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => \Illuminate\Support\Str::random(32), // Mot de passe aléatoire
                'email_verified_at' => now(), // Email vérifié via OAuth
            ]);
        }

        // Créer le lien avec le compte social
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'avatar' => $socialUser->getAvatar(),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Compte créé et connecté avec succès!');
    }
}
