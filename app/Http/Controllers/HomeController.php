<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // On récupère quelques talents pour le bandeau défilant
        $players = User::where('is_public', true)
            ->whereNotNull('profile_photo')
            ->inRandomOrder()
            ->limit(12)
            ->get();

        return view('home', compact('players'));
    }
}
