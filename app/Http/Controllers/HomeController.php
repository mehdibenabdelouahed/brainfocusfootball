<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $players = User::whereHas('player', function ($q) {
            $q->where('visibility', 'public')->whereNotNull('profile_photo');
        })->with('player')
          ->inRandomOrder()
          ->limit(12)
          ->get();

        return view('home', compact('players'));
    }
}
