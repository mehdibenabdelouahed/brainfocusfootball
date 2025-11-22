<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HowItWorksController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/mot-de-passe-oublie', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/mot-de-passe-oublie', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reinitialiser-mot-de-passe/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reinitialiser-mot-de-passe', [AuthController::class, 'resetPassword'])->name('password.update');

// Email verification routes
Route::get('/email/verify', [AuthController::class, 'showVerifyEmailNotice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// OAuth routes
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

// Page liste des articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Page article Nutrition
Route::get('/articles/nutrition', function () {
    return view('article');
})->name('articles.nutrition');

// Profil joueur
Route::get('/profil-joueur', [PlayerProfileController::class, 'index'])->middleware('auth')->name('player.profile');

// Page Contact (Remplaçant Comment ça marche)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Debug route for PHP config
Route::get('/debug-config', function () {
    return [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
    ];
});

// Profile routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/profil/creer', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profil/creer', [ProfileController::class, 'store']);
    Route::get('/profil/editer', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/editer', [ProfileController::class, 'update']);
});

// Public profile view
Route::get('/profil/{id}', [ProfileController::class, 'show'])->name('profile.show');

// TEST ROUTE FOR NEW DESIGN
Route::get('/test-article', function () {
    return view('article');
});
