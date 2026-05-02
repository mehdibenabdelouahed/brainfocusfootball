<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isRecruiter()) {
            return view('dashboard.recruiter', compact('user'));
        }

        if ($user->role === 'guardian') {
            return view('dashboard.guardian', compact('user'));
        }

        // Si le joueur vient d'être créé, il se peut qu'il n'y ait pas de player associé dans de très rares cas, mais la méthode register le crée.
        $player = $user->player;

        // Calcul du pourcentage de complétion du profil
        $fields = [
            'date_of_birth', 'position', 'dominant_foot', 'height_cm', 'current_club',
        ];
        $filled = 0;
        if ($player) {
            foreach ($fields as $field) {
                if (!empty($player->$field)) {
                    $filled++;
                }
            }
        }
        $completionPercent = (int) round(($filled / max(1, count($fields))) * 100);

        // Articles recommandés selon le poste du joueur
        $positionCategories = [
            'Gardien'    => 'Préparation physique',
            'Défenseur'  => 'Techniques et tactiques',
            'Milieu'     => 'Préparation mentale',
            'Attaquant'  => 'Préparation mentale',
        ];
        $recommendedCategory = null;
        if ($player && $player->position) {
            foreach ($positionCategories as $key => $cat) {
                if (str_contains(strtolower($player->position), strtolower($key))) {
                    $recommendedCategory = $cat;
                    break;
                }
            }
        }
        
        $articles = Article::published()
            ->when($recommendedCategory, fn($q) => $q->where('category', $recommendedCategory))
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($articles->isEmpty()) {
            $articles = Article::published()->latest('published_at')->take(3)->get();
        }

        // --- Analytiques d'audience (PREMIUM ONLY) ---
        $viewsCount = 0;
        $favoritedCount = 0;
        if ($player && $user->isPremium()) {
            $viewsCount = $player->profileViews()->count();
            $favoritedCount = $player->favoritedBy()->count();
        }

        return view('dashboard.player', compact('user', 'player', 'completionPercent', 'articles', 'viewsCount', 'favoritedCount'));
    }
}
