<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════════════════
// RACINE — redirige vers la locale par défaut
// ══════════════════════════════════════════════════════════
Route::get('/', function () {
    $browserLocale = substr(request()->server('HTTP_ACCEPT_LANGUAGE', 'fr'), 0, 2);
    $locale = in_array($browserLocale, config('app.available_locales', ['fr'])) ? $browserLocale : 'fr';
    return redirect("/{$locale}");
});

// ══════════════════════════════════════════════════════════
// ROUTES OAUTH (hors préfixe de langue pour correspondre aux URI de callback standard)
// ══════════════════════════════════════════════════════════
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

if (app()->environment('local')) {
    Route::get('/auth/{provider}/mock', [SocialAuthController::class, 'showMockForm'])->name('social.mock');
    Route::post('/auth/{provider}/mock/submit', [SocialAuthController::class, 'handleMockCallback'])->name('social.mock.submit');
}

// ══════════════════════════════════════════════════════════
// TOUTES LES ROUTES SOUS PRÉFIXE {locale}
// ══════════════════════════════════════════════════════════
Route::prefix('{locale}')
    ->where(['locale' => 'fr|en|nl'])
    ->middleware('locale')
    ->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Authentication routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    // Password reset routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

    // Email verification routes
    Route::get('/email/verify', [AuthController::class, 'showVerifyEmailNotice'])->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    // Articles (public)
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/nutrition', function () {
        return view('articles.nutrition');
    })->name('articles.nutrition');
    Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

    // Page Contact (public)
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // Page À Propos (public)
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // Newsletter (public)
    Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

    // Pages légales (public)
    Route::get('/legal', function () {
        return view('legal.mentions-legales');
    })->name('legal.mentions');
    Route::get('/privacy', function () {
        return view('legal.confidentialite');
    })->name('legal.privacy');
    Route::get('/terms', function () {
        return view('legal.cgu');
    })->name('legal.cgu');

    // ══════════════════════════════════════════════════════════
    // ROUTES PROTÉGÉES PAR AUTHENTIFICATION
    // ══════════════════════════════════════════════════════════

    // Galerie de talents — requiert d'être connecté
    Route::get('/talents', [PlayerProfileController::class, 'index'])->middleware('auth')->name('talents');

    // Profil joueur public (reste accessible sans auth pour le partage de lien)
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show')->where('id', '[0-9]+');

    // Comparateur — requiert d'être connecté + recruteur avec plan ≥ STANDARD
    Route::get('/compare', [PlayerProfileController::class, 'compare'])
        ->middleware(['auth', 'role:recruiter', 'subscription:STANDARD,PRO,ACADEMIE'])
        ->name('compare');

    // Page upgrade required (pour les redirections de middleware)
    Route::get('/upgrade-required', function () {
        return view('auth.upgrade-required');
    })->middleware('auth')->name('upgrade.required');

    // Profile routes (protected by auth middleware)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile/create', [ProfileController::class, 'store']);
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/edit', [ProfileController::class, 'update']);
        
        // Routes Tuteur
        Route::post('/guardian/approve', [\App\Http\Controllers\GuardianController::class, 'approveConsent'])->name('guardian.approve');
        
        // Espace Médical
        Route::get('/medical/edit', [\App\Http\Controllers\MedicalDataController::class, 'edit'])->name('medical.edit');
        Route::put('/medical/update', [\App\Http\Controllers\MedicalDataController::class, 'update'])->name('medical.update');

        // Favoris — réservé aux recruteurs
        Route::post('/favorites/toggle', [\App\Http\Controllers\FavoriteController::class, 'toggle'])
            ->middleware('role:recruiter')
            ->name('favorites.toggle');

        // Abonnements (Pricing & Checkout)
        Route::get('/pricing', [\App\Http\Controllers\SubscriptionController::class, 'pricing'])->name('pricing');
        Route::get('/checkout', [\App\Http\Controllers\SubscriptionController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/process', [\App\Http\Controllers\SubscriptionController::class, 'processCheckout'])->name('checkout.process');

        // Administration
        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
            Route::post('/users/{user}/ban', [\App\Http\Controllers\AdminController::class, 'banUser'])->name('users.ban');
            Route::post('/users/{user}/unban', [\App\Http\Controllers\AdminController::class, 'unbanUser'])->name('users.unban');
            Route::resource('articles', App\Http\Controllers\AdminArticleController::class);
        });

        // Messagerie Interne — réservée aux joueurs et recruteurs
        Route::middleware('role:recruiter,player')->group(function () {
            Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
            Route::get('/messages/{conversation}', [\App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
            Route::post('/messages/{conversation}', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
            Route::post('/messages/initiate/{player}', [\App\Http\Controllers\MessageController::class, 'initiate'])->name('messages.initiate');
        });
    });
});
