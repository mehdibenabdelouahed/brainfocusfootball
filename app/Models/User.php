<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Informations personnelles
        'first_name',
        'last_name',
        'date_of_birth',
        'profile_photo',
        'phone',
        // Informations sportives
        'position',
        'preferred_foot',
        'height',
        'weight',
        'current_club',
        'level',
        'jersey_number',
        // Médias
        'main_video_url',
        'main_video_file',
        'secondary_videos',
        'photos',
        // Profil
        'bio',
        'goals',
        'achievements',
        // Statistiques
        'matches_played',
        'goals_scored',
        'assists',
        'season',
        // Réseaux sociaux
        'instagram_url',
        'tiktok_url',
        'youtube_url',
        // Métadonnées
        'profile_completed',
        'is_public',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'secondary_videos' => 'array',
            'photos' => 'array',
            'goals' => 'array',
            'achievements' => 'array',
            'profile_completed' => 'boolean',
            'is_public' => 'boolean',
        ];
    }
}
