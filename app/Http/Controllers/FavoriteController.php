<?php

namespace App\Http\Controllers;

use App\Mail\PlayerFavorited;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FavoriteController extends Controller
{
    /**
     * Ajouter ou retirer un joueur des favoris du recruteur (toggle).
     */
    public function toggle(Player $player)
    {
        $user = Auth::user();

        if (!$user->isRecruiter() || !$user->recruiter) {
            abort(403, 'Seuls les recruteurs peuvent gérer des favoris.');
        }

        if (!in_array($user->recruiterPlan(), ['PRO', 'ACADEMIE'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'L\'ajout aux favoris est réservé aux abonnements PRO et Académie. Veuillez mettre à niveau votre plan.',
                'redirect' => route('pricing')
            ], 403);
        }

        $recruiter = $user->recruiter;
        $alreadyFavorited = $recruiter->favoritePlayers()->where('player_id', $player->id)->exists();

        if ($alreadyFavorited) {
            // Retirer des favoris
            $recruiter->favoritePlayers()->detach($player->id);
            return response()->json([
                'status' => 'removed',
                'message' => 'Joueur retiré de vos favoris.',
            ]);
        } else {
            // Ajouter aux favoris
            $recruiter->favoritePlayers()->attach($player->id);

            // Envoyer la notification par e-mail au joueur
            $playerUser = $player->user;
            if ($playerUser && $playerUser->email) {
                Mail::to($playerUser->email)->send(new PlayerFavorited($player, $recruiter));
            }

            return response()->json([
                'status' => 'added',
                'message' => 'Joueur ajouté à vos favoris ! Le joueur a été notifié.',
            ]);
        }
    }
}
