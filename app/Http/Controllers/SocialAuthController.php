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
    public function redirectToProvider(string $provider, Request $request)
    {
        // Store current locale to session to redirect to the correct localized route afterwards
        $locale = $request->query('locale') ?? app()->getLocale() ?? 'fr';
        session(['oauth_locale' => $locale]);

        if ($request->has('role')) {
            session(['oauth_role' => $request->query('role')]);
        }

        if (app()->environment('local') && $this->isMockable($provider)) {
            return redirect()->route('social.mock', ['provider' => $provider]);
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Socialite Redirect Error: " . $e->getMessage());
            return redirect()->route('login', ['locale' => $locale])
                ->withErrors(['email' => 'Impossible de rediriger vers ' . ucfirst($provider)]);
        }
    }

    /**
     * Gère le callback du provider OAuth
     */
    public function handleProviderCallback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Socialite Callback Error for {$provider}: " . $e->getMessage());
            $locale = session('oauth_locale', 'fr');
            return redirect()->route('login', ['locale' => $locale])
                ->withErrors(['email' => 'Erreur lors de la connexion avec ' . ucfirst($provider)]);
        }

        return $this->processSocialUser($provider, $socialUser);
    }

    /**
     * Affiche le formulaire de simulation locale (Mock)
     */
    public function showMockForm(string $provider)
    {
        if (!app()->environment('local')) {
            abort(404);
        }
        $role = session('oauth_role', 'player');
        return view('auth.mock-oauth', compact('provider', 'role'));
    }

    /**
     * Gère le callback de simulation locale (Mock)
     */
    public function handleMockCallback(Request $request, string $provider)
    {
        if (!app()->environment('local')) {
            abort(404);
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'id' => 'required|string',
            'avatar' => 'nullable|string',
            'role' => 'required|in:player,recruiter',
        ]);

        // Save mock role to session
        session(['oauth_role' => $validated['role']]);

        // Simuler l'objet utilisateur Socialite
        $mockUser = new class($validated) {
            private $data;
            public function __construct($data) { $this->data = $data; }
            public function getId() { return $this->data['id']; }
            public function getName() { return $this->data['name']; }
            public function getEmail() { return $this->data['email']; }
            public function getAvatar() { return $this->data['avatar'] ?? 'https://www.gravatar.com/avatar/' . md5($this->data['email']) . '?d=mp'; }
        };

        return $this->processSocialUser($provider, $mockUser);
    }

    /**
     * Traite l'utilisateur connecté via un compte social (réel ou simulé)
     */
    private function processSocialUser(string $provider, $socialUser)
    {
        $locale = session()->pull('oauth_locale', 'fr');

        // Chercher un compte social existant
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($socialAccount) {
            // L'utilisateur existe déjà via ce provider, on le connecte
            $user = $socialAccount->user;
            
            // S'assurer que le profil associé existe
            $this->ensureProfileExists($user, $socialUser);

            Auth::login($user);
            return redirect()->route('dashboard', ['locale' => $locale])->with('success', 'Connexion réussie!');
        }

        // Chercher un utilisateur avec le même email
        $user = User::where('email', $socialUser->getEmail())->first();
        $isNewUser = false;

        if (!$user) {
            $isNewUser = true;
            // Déterminer le rôle à partir de la session ou défaut 'player'
            $role = session()->pull('oauth_role', 'player');
            if (!in_array($role, ['player', 'recruiter'])) {
                $role = 'player';
            }

            // Créer un nouvel utilisateur
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => \Illuminate\Support\Str::random(32), // Mot de passe aléatoire
                'email_verified_at' => now(), // Email vérifié via OAuth
                'role' => $role,
            ]);
        }

        // S'assurer que le profil associé (Player ou Recruiter) est créé
        $this->ensureProfileExists($user, $socialUser);

        // Créer le lien avec le compte social
        SocialAccount::firstOrCreate([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
        ], [
            'user_id' => $user->id,
            'avatar' => $socialUser->getAvatar(),
        ]);

        Auth::login($user);

        if ($isNewUser) {
            if ($user->isPlayer()) {
                return redirect()->route('profile.edit', ['locale' => $locale])
                    ->with('success', 'Compte créé avec succès ! Complétez maintenant votre profil.');
            } else {
                return redirect()->route('dashboard', ['locale' => $locale])
                    ->with('success', 'Compte Recruteur créé avec succès !');
            }
        }

        return redirect()->route('dashboard', ['locale' => $locale])->with('success', 'Connexion réussie!');
    }

    /**
     * S'assure que le profil associé (Joueur ou Recruteur) existe en base de données
     */
    private function ensureProfileExists(User $user, $socialUser): void
    {
        if ($user->isPlayer()) {
            if (!$user->player) {
                $nameParts = explode(' ', $socialUser->getName(), 2);
                $firstName = $nameParts[0] ?? '';
                $lastName = $nameParts[1] ?? '';

                \App\Models\Player::create([
                    'user_id' => $user->id,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'profile_photo' => $socialUser->getAvatar(),
                    'profile_completed' => false,
                ]);
            }
        } elseif ($user->isRecruiter()) {
            if (!$user->recruiter) {
                \App\Models\Recruiter::create([
                    'user_id' => $user->id,
                    'org_name' => 'Structure Google',
                    'is_verified' => false,
                ]);
            }
        }
    }

    /**
     * Détermine si le provider est "mockable" (utilisable en simulation locale)
     */
    private function isMockable(string $provider): bool
    {
        $clientId = config("services.{$provider}.client_id");
        return empty($clientId) || str_contains($clientId, 'your_') || $clientId === 'placeholder';
    }
}
