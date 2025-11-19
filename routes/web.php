<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\HowItWorksController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Page liste des articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Page article Nutrition (vue: resources/views/articles/nutrition.blade.php)
Route::get('/articles/nutrition', function () {
    return view('articles.nutrition');
})->name('articles.nutrition');

// Profil joueur
Route::get('/profil-joueur', [PlayerProfileController::class, 'index'])->name('player.profile');

// Comment ça marche
Route::get('/comment-ca-marche', [HowItWorksController::class, 'index'])->name('how-it-works');

