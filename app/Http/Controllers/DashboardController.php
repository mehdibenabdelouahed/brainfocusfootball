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

        // Calcul du pourcentage de complétion du profil
        $fields = [
            'first_name', 'last_name', 'date_of_birth', 'profile_photo',
            'position', 'preferred_foot', 'height', 'current_club',
            'level', 'bio', 'main_video_url',
        ];
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($user->$field)) {
                $filled++;
            }
        }
        $completionPercent = (int) round(($filled / count($fields)) * 100);

        // Articles recommandés selon le poste du joueur
        $positionCategories = [
            'Gardien'    => 'Préparation physique',
            'Défenseur'  => 'Techniques et tactiques',
            'Milieu'     => 'Préparation mentale',
            'Attaquant'  => 'Préparation mentale',
        ];
        $recommendedCategory = null;
        foreach ($positionCategories as $key => $cat) {
            if ($user->position && str_contains(strtolower($user->position), strtolower($key))) {
                $recommendedCategory = $cat;
                break;
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

        return view('dashboard', compact('user', 'completionPercent', 'articles'));
    }
}
