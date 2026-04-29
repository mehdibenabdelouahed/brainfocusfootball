<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ProfileController;
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

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/nutrition', function () {
    return view('articles.nutrition');
})->name('articles.nutrition');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Profil joueur (galerie publique)
Route::get('/profil-joueur', [PlayerProfileController::class, 'index'])->name('talents');

// Page Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Newsletter
Route::post('/newsletter/subscribe', [App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Profile routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil/creer', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profil/creer', [ProfileController::class, 'store']);
    Route::get('/profil/editer', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil/editer', [ProfileController::class, 'update']);
});

// Public profile view
Route::get('/profil/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Comparateur
Route::get('/comparateur', [PlayerProfileController::class, 'compare'])->name('compare');

// Admin routes (protected by auth + admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('articles', App\Http\Controllers\AdminArticleController::class);
});
