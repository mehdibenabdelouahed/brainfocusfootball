<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class PlayerProfileController extends Controller
{
    public function index()
    {
        // Récupérer tous les profils publics
        $players = User::where('is_public', true)
            ->latest()
            ->paginate(12);

        return view('player-profile', compact('players'));
    }
}






