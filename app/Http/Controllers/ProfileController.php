<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire de création de profil
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Enregistre le profil joueur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Informations personnelles
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            
            // Informations sportives
            'position' => ['nullable', 'string', 'max:255'],
            'preferred_foot' => ['nullable', 'in:Droit,Gauche,Ambidextre'],
            'height' => ['nullable', 'integer', 'min:100', 'max:250'],
            'weight' => ['nullable', 'integer', 'min:30', 'max:150'],
            'current_club' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'jersey_number' => ['nullable', 'integer', 'min:1', 'max:99'],
            
            // Médias
            'main_video_url' => ['nullable', 'url'],
            'main_video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo', 'max:51200'], // Max 50MB
            'secondary_videos' => ['nullable', 'array'],
            'secondary_videos.*' => ['url'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['image', 'max:2048'],
            
            // Profil
            'bio' => ['nullable', 'string', 'max:1000'],
            'goals' => ['nullable', 'array'],
            'achievements' => ['nullable', 'array'],
            
            // Statistiques
            'matches_played' => ['nullable', 'integer', 'min:0'],
            'goals_scored' => ['nullable', 'integer', 'min:0'],
            'assists' => ['nullable', 'integer', 'min:0'],
            'season' => ['nullable', 'string', 'max:20'],
            
            // Réseaux sociaux
            'instagram_url' => ['nullable', 'url'],
            'tiktok_url' => ['nullable', 'url'],
            'youtube_url' => ['nullable', 'url'],
            
            // Métadonnées
            'is_public' => ['boolean'],

            // Radar de performance
            'radar_mental' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_physique' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_technique' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_vitesse' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_vision' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_social' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $user = Auth::user();

        if (!$user->isPlayer()) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Seuls les joueurs peuvent compléter un profil sportif.']);
        }

        $player = $user->player ?? \App\Models\Player::create(['user_id' => $user->id]);

        // Upload de la photo de profil
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // Upload de la vidéo principale
        if ($request->hasFile('main_video_file')) {
            $path = $request->file('main_video_file')->store('player_videos', 'public');
            if ($path && Storage::disk('public')->exists($path)) {
                $validated['main_video_file'] = $path;
            }
        }

        // Marquer le profil comme complété
        $validated['profile_completed'] = true;

        // RGPD & Consentement
        $isPublic = $request->has('is_public') ? $request->boolean('is_public') : true;
        $age = \Carbon\Carbon::parse($validated['date_of_birth'] ?? now())->age;
        
        if ($age < 18 && $isPublic) {
            $guardian = $user->guardian;
            if (!$guardian || !$guardian->consent_given) {
                $isPublic = false;
            }
        }
        
        $validated['visibility'] = $isPublic ? 'public' : 'private';
        unset($validated['is_public']); // Pas dans la table players

        $player->update($validated);

        return redirect()->route('profile.show', $user->id)->with('success', 'Profil créé avec succès!');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Met à jour le profil
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Mêmes validations que store()
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
            'position' => ['nullable', 'string', 'max:255'],
            'preferred_foot' => ['nullable', 'in:Droit,Gauche,Ambidextre'],
            'height' => ['nullable', 'integer', 'min:100', 'max:250'],
            'weight' => ['nullable', 'integer', 'min:30', 'max:150'],
            'current_club' => ['nullable', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'jersey_number' => ['nullable', 'integer', 'min:1', 'max:99'],
            'main_video_url' => ['nullable', 'url'],
            'main_video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo', 'max:51200'],
            'secondary_videos' => ['nullable', 'array'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'goals' => ['nullable', 'array'],
            'achievements' => ['nullable', 'array'],
            'matches_played' => ['nullable', 'integer', 'min:0'],
            'goals_scored' => ['nullable', 'integer', 'min:0'],
            'assists' => ['nullable', 'integer', 'min:0'],
            'season' => ['nullable', 'string', 'max:20'],
            'youtube_url' => ['nullable', 'url'],
            'is_public' => ['boolean'],

            // Radar de performance
            'radar_mental' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_physique' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_technique' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_vitesse' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_vision' => ['nullable', 'integer', 'min:1', 'max:10'],
            'radar_social' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $user = Auth::user();

        if (!$user->isPlayer()) {
            return redirect()->route('dashboard')->withErrors(['error' => 'Seuls les joueurs peuvent avoir un profil sportif.']);
        }

        $player = $user->player ?? \App\Models\Player::create(['user_id' => $user->id]);

        // Upload de la photo de profil
        if ($request->hasFile('profile_photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($player->profile_photo) {
                Storage::disk('public')->delete($player->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        }

        // Upload de la vidéo principale
        if ($request->hasFile('main_video_file')) {
            // Supprimer l'ancienne vidéo si elle existe
            if ($player->main_video_file) {
                Storage::disk('public')->delete($player->main_video_file);
            }
            $path = $request->file('main_video_file')->store('player_videos', 'public');
            if ($path && Storage::disk('public')->exists($path)) {
                $validated['main_video_file'] = $path;
            }
        }

        // RGPD & Consentement
        $isPublic = $request->has('is_public') ? $request->boolean('is_public') : true;
        $age = \Carbon\Carbon::parse($validated['date_of_birth'] ?? $player->date_of_birth ?? now())->age;
        
        if ($age < 18 && $isPublic) {
            $guardian = $user->guardian;
            if (!$guardian || !$guardian->consent_given) {
                $isPublic = false;
            }
        }

        $validated['visibility'] = $isPublic ? 'public' : 'private';
        unset($validated['is_public']); // Pas dans la table players

        $player->update($validated);

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès!');
    }

    /**
     * Affiche un profil public
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $player = $user->player;
        $isPublic = $player ? ($player->visibility === 'public') : ($user->is_public ?? true);

        // Vérifier si le profil est public ou si c'est le propriétaire
        if (!$isPublic && (!Auth::check() || Auth::id() !== $user->id)) {
            abort(403, 'Ce profil est privé.');
        }

        // Enregistrer la vue du profil (si ce n'est pas le propriétaire)
        if ($player && (!Auth::check() || Auth::id() !== $user->id)) {
            $viewerId = Auth::id();
            $viewerRole = Auth::check() && Auth::user()->isRecruiter() ? 'recruiter' : (Auth::check() ? 'user' : 'guest');
            
            // Éviter les doublons dans la même heure par la même IP / Utilisateur
            $recentView = \App\Models\ProfileView::where('player_id', $player->id)
                ->where(function ($query) use ($viewerId) {
                    if ($viewerId) {
                        $query->where('viewer_id', $viewerId);
                    } else {
                        $query->where('ip_address', request()->ip());
                    }
                })
                ->where('created_at', '>=', now()->subHour())
                ->first();

            if (!$recentView) {
                \App\Models\ProfileView::create([
                    'player_id' => $player->id,
                    'viewer_id' => $viewerId,
                    'viewer_role' => $viewerRole,
                    'ip_address' => request()->ip(),
                ]);
            }
        }

        return view('profile.show', compact('user'));
    }
}
