<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Check if user is banned
            if (Auth::user()->banned_at) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Votre compte a été suspendu par un administrateur.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:player,recruiter'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            // Player fields
            'date_of_birth' => ['nullable', 'required_if:role,player', 'date'],
            'position' => ['nullable', 'string', 'max:255'],
            'guardian_email' => ['nullable', 'email'],
            // Recruiter fields
            'org_name' => ['nullable', 'required_if:role,recruiter', 'string', 'max:255'],
            'license_number' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'], // The 'hashed' cast will hash this automatically
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'player') {
            $player = \App\Models\Player::create([
                'user_id' => $user->id,
                'date_of_birth' => $validated['date_of_birth'],
                'position' => $validated['position'] ?? null,
            ]);

            // Vérifier si le joueur est mineur
            $age = \Carbon\Carbon::parse($validated['date_of_birth'])->age;
            if ($age < 18) {
                // Création du compte tuteur (basique)
                $tempPassword = \Illuminate\Support\Str::random(10);
                
                $guardianUser = User::firstOrCreate(
                    ['email' => $validated['guardian_email']],
                    [
                        'name' => 'Tuteur de ' . $validated['name'],
                        'password' => \Illuminate\Support\Facades\Hash::make($tempPassword),
                        'role' => 'guardian',
                    ]
                );

                $guardian = \App\Models\Guardian::create([
                    'user_id' => $guardianUser->id,
                    'player_id' => $player->id,
                    'consent_given' => false,
                ]);

                $player->update(['guardian_id' => $guardian->id]);
                
                // Envoyer l'email au tuteur uniquement si le compte vient d'être créé
                if ($guardianUser->wasRecentlyCreated) {
                    try {
                        \Illuminate\Support\Facades\Mail::to($guardianUser->email)->send(
                            new \App\Mail\GuardianAccountCreated($validated['name'], $guardianUser->email, $tempPassword)
                        );
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Erreur lors de l\'envoi de l\'email au tuteur: ' . $e->getMessage());
                    }
                }
            }
        } else if ($validated['role'] === 'recruiter') {
            \App\Models\Recruiter::create([
                'user_id' => $user->id,
                'org_name' => $validated['org_name'],
                'license_number' => $validated['license_number'] ?? null,
            ]);
        }

        Auth::login($user);

        // TODO: Configurer SMTP dans .env pour activer l'envoi d'emails
        // Pour l'instant, l'email de vérification est désactivé pour permettre l'inscription
        
        /*
        // Générer l'URL de vérification
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->getEmailForVerification())]
        );

        // Envoyer l'email de vérification
        \Illuminate\Support\Facades\Mail::to($user->email)->send(
            new \App\Mail\VerifyEmailMail($user, $verificationUrl)
        );

        return redirect()->route('verification.notice')->with('success', 'Compte créé avec succès! Vérifiez votre email pour continuer.');
        */

        // Redirection en fonction du rôle
        if ($user->isPlayer()) {
            return redirect()->route('profile.create')->with('success', 'Compte Joueur créé avec succès! Complète maintenant ton profil.');
        } else {
            return redirect()->route('dashboard')->with('success', 'Compte Recruteur créé en attente de validation.');
        }
    }

    /**
     * Affiche le formulaire "Mot de passe oublié"
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envoie le lien de réinitialisation par email
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Aucun compte ne correspond à cette adresse email.']);
        }

        // Générer un token unique
        $token = \Illuminate\Support\Str::random(64);

        // Stocker le token dans la base de données
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => \Illuminate\Support\Facades\Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Envoyer l'email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(
            new \App\Mail\ResetPasswordMail($token, $user->email)
        );

        return back()->with('status', 'Un lien de réinitialisation a été envoyé à votre adresse email!');
    }

    /**
     * Affiche le formulaire de réinitialisation
     */
    public function showResetPasswordForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Réinitialise le mot de passe
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Vérifier le token
        $resetRecord = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Ce lien de réinitialisation est invalide.']);
        }

        // Vérifier que le token correspond
        if (!\Illuminate\Support\Facades\Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Ce lien de réinitialisation est invalide.']);
        }

        // Vérifier que le token n'est pas expiré (60 minutes)
        if (now()->diffInMinutes($resetRecord->created_at) > 60) {
            return back()->withErrors(['email' => 'Ce lien de réinitialisation a expiré.']);
        }

        // Mettre à jour le mot de passe
        $user = User::where('email', $request->email)->first();
        $user->password = $request->password;
        $user->save();

        // Supprimer le token utilisé
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Connecter l'utilisateur
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Votre mot de passe a été réinitialisé avec succès !');
    }

    /**
     * Affiche la page de notification de vérification d'email
     */
    public function showVerifyEmailNotice()
    {
        return auth()->user()->hasVerifiedEmail()
            ? redirect()->route('home')
            : view('auth.verify-email');
    }

    /**
     * Vérifie l'email via le lien
     */
    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        // Vérifier la signature du lien
        if (!hash_equals(
            (string) $request->route('hash'),
            sha1($user->getEmailForVerification())
        )) {
            return redirect()->route('home')->withErrors(['email' => 'Lien de vérification invalide.']);
        }

        // Marquer l'email comme vérifié
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('home')->with('success', 'Votre email a été vérifié avec succès!');
    }

    /**
     * Renvoie l'email de vérification
     */
    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        // Générer l'URL de vérification
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $request->user()->id, 'hash' => sha1($request->user()->getEmailForVerification())]
        );

        // Envoyer l'email
        \Illuminate\Support\Facades\Mail::to($request->user()->email)->send(
            new \App\Mail\VerifyEmailMail($request->user(), $verificationUrl)
        );

        return back()->with('status', 'verification-link-sent');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
