<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PlayerProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereHas('player', function ($q) {
            $q->where('visibility', 'public')->whereNotNull('first_name');
        })->with('player');

        // Recherche par nom, prénom ou club
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('player', function($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('current_club', 'like', '%' . $search . '%');
            });
        }

        // Filtre par poste
        if ($request->filled('position')) {
            $query->whereHas('player', function($q) use ($request) {
                $q->where('position', 'like', '%' . $request->position . '%');
            });
        }

        // Filtre par niveau
        if ($request->filled('level')) {
            $query->whereHas('player', function($q) use ($request) {
                $q->where('level', 'like', '%' . $request->level . '%');
            });
        }

        // Filtre par tranche d'âge
        if ($request->filled('age_group')) {
            $group = $request->age_group;
            $now = now();
            $query->whereHas('player', function($q) use ($group, $now) {
                if ($group === 'U15') {
                    $q->whereBetween('date_of_birth', [$now->copy()->subYears(15), $now->copy()->subYears(13)]);
                } elseif ($group === 'U17') {
                    $q->whereBetween('date_of_birth', [$now->copy()->subYears(17), $now->copy()->subYears(16)]);
                } elseif ($group === 'U19') {
                    $q->whereBetween('date_of_birth', [$now->copy()->subYears(19), $now->copy()->subYears(18)]);
                } elseif ($group === 'Senior') {
                    $q->where('date_of_birth', '<', $now->copy()->subYears(19));
                }
            });
        }

        // Filtres Radar avancés (Réservés aux plans STANDARD, PRO, ACADEMIE)
        $isRecruiter = Auth::check() && Auth::user()->isRecruiter();
        $hasAdvancedSearch = $isRecruiter && in_array(Auth::user()->recruiterPlan(), ['STANDARD', 'PRO', 'ACADEMIE']);

        if ($hasAdvancedSearch) {
            $radarFields = [
                'radar_mental'    => 'mental_min',
                'radar_physical'  => 'physical_min',
                'radar_technical' => 'technical_min',
                'radar_speed'     => 'speed_min',
                'radar_vision'    => 'vision_min',
                'radar_social'    => 'social_min',
            ];
            foreach ($radarFields as $column => $param) {
                if ($request->filled($param) && is_numeric($request->$param)) {
                    $minVal = (int) $request->$param;
                    $query->whereHas('player', function($q) use ($column, $minVal) {
                        $q->where($column, '>=', $minVal);
                    });
                }
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
