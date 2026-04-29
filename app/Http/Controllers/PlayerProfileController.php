<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PlayerProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_public', true)
            ->whereNotNull('first_name');

        // Recherche par nom, prénom ou club
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('current_club', 'like', '%' . $search . '%');
            });
        }

        // Filtre par poste
        if ($request->filled('position')) {
            $query->where('position', 'like', '%' . $request->position . '%');
        }

        // Filtre par niveau
        if ($request->filled('level')) {
            $query->where('level', 'like', '%' . $request->level . '%');
        }

        // Filtre par tranche d'âge
        if ($request->filled('age_group')) {
            $group = $request->age_group;
            $now = now();
            if ($group === 'U15') {
                $query->whereBetween('date_of_birth', [$now->copy()->subYears(15), $now->copy()->subYears(13)]);
            } elseif ($group === 'U17') {
                $query->whereBetween('date_of_birth', [$now->copy()->subYears(17), $now->copy()->subYears(16)]);
            } elseif ($group === 'U19') {
                $query->whereBetween('date_of_birth', [$now->copy()->subYears(19), $now->copy()->subYears(18)]);
            } elseif ($group === 'Senior') {
                $query->where('date_of_birth', '<', $now->copy()->subYears(19));
            }
        }

        $players = $query->latest()->paginate(12)->withQueryString();

        $positions = ['Gardien', 'Défenseur', 'Milieu', 'Attaquant'];
        $levels = ['Régional', 'National', 'Élite', 'Académie'];
        $ageGroups = ['U15', 'U17', 'U19', 'Senior'];

        return $request->ajax() 
            ? view('partials.player-grid', compact('players'))->render()
            : view('player-profile', compact('players', 'positions', 'levels', 'ageGroups'));
    }

    public function compare(Request $request)
    {
        $ids = explode(',', $request->ids);
        $players = User::whereIn('id', $ids)->get();

        if ($players->count() < 2) {
            return redirect()->route('talents')->with('error', 'Sélectionnez au moins 2 joueurs.');
        }

        return view('compare', compact('players'));
    }
}
