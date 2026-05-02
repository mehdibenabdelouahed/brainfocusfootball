<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Player;
use App\Models\Subscription;
use App\Models\ProfileView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Santé Financière (MRR)
        $activeSubs = Subscription::where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })->get();

        $mrr = 0;
        $planPrices = [
            'PREMIUM' => 9,
            'STANDARD' => 29,
            'PRO' => 79,
            'ACADEMIE' => 199,
        ];
        
        $planBreakdown = [];

        foreach ($activeSubs as $sub) {
            $price = $planPrices[$sub->plan_name] ?? 0;
            $mrr += $price;
            
            if (!isset($planBreakdown[$sub->plan_name])) {
                $planBreakdown[$sub->plan_name] = 0;
            }
            $planBreakdown[$sub->plan_name]++;
        }

        // 2. Engagement des Joueurs
        $totalPlayers = User::where('role', 'player')->count();
        $totalRecruiters = User::where('role', 'recruiter')->count();
        $totalGuardians = User::where('role', 'guardian')->count();

        // Taux de complétion (basé sur le nombre de joueurs ayant rempli un critère clé)
        $completedProfiles = Player::whereNotNull('current_club')->count();
        $completionRate = $totalPlayers > 0 ? round(($completedProfiles / $totalPlayers) * 100) : 0;

        // Top 5 Talents (par nombre de favoris)
        $topTalents = Player::withCount('favoritedBy')
            ->orderByDesc('favorited_by_count')
            ->take(5)
            ->get();

        // Utilisation du Dossier Médical
        $medicalUsersCount = DB::table('medical_data')->count();

        // 3. Activité
        $totalViews = ProfileView::count();

        // Utilisateurs pour la liste (Pagination)
        $users = User::latest()->paginate(20);

        return view('admin.dashboard', compact(
            'mrr', 'planBreakdown', 'totalPlayers', 'totalRecruiters', 'totalGuardians',
            'completionRate', 'topTalents', 'medicalUsersCount', 'totalViews', 'users'
        ));
    }

    public function banUser(Request $request, User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Vous ne pouvez pas bannir un administrateur.');
        }

        $user->banned_at = now();
        $user->save();

        return back()->with('success', 'L\'utilisateur a été banni avec succès.');
    }

    public function unbanUser(Request $request, User $user)
    {
        $user->banned_at = null;
        $user->save();

        return back()->with('success', 'L\'utilisateur a été réintégré.');
    }
}
