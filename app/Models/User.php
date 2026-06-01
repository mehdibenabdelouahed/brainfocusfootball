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

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        ];
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function recruiter()
    {
        return $this->hasOne(Recruiter::class);
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }

    public function isPlayer(): bool
    {
        return $this->role === 'player';
    }

    public function isRecruiter(): bool
    {
        return $this->role === 'recruiter';
    }

    public function isGuardian(): bool
    {
        return $this->role === 'guardian';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->where(function ($query) {
            $query->whereNull('ends_at')->orWhere('ends_at', '>', now());
        })->latest();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function hasActiveSubscription($planName = null)
    {
        $activeSub = $this->activeSubscription;
        if (!$activeSub) return false;

        if ($planName) {
            return $activeSub->plan_name === $planName;
        }

        return true;
    }

    public function isPremium()
    {
        if ($this->role === 'player') {
            return $this->hasActiveSubscription('PREMIUM');
        }
        return false;
    }

    public function recruiterPlan()
    {
        if ($this->role !== 'recruiter') return 'GRATUIT';

        $activeSub = $this->activeSubscription;
        return $activeSub ? $activeSub->plan_name : 'GRATUIT';
    }

    public function recruiterConversations()
    {
        return $this->hasMany(Conversation::class, 'recruiter_id');
    }

    public function playerConversations()
    {
        return $this->hasMany(Conversation::class, 'player_id');
    }

    public function getConversationsAttribute()
    {
        if ($this->role === 'recruiter') {
            return $this->recruiterConversations;
        } elseif ($this->role === 'player') {
            return $this->playerConversations;
        }
        return collect();
    }

    public function canContactPlayer()
    {
        if ($this->role !== 'recruiter') return false;

        $plan = $this->recruiterPlan();

        if ($plan === 'GRATUIT') {
            return false;
        }

        if (in_array($plan, ['PRO', 'ACADEMIE'])) {
            return true; // Illimité
        }

        if ($plan === 'STANDARD') {
            // Limite de 10 nouvelles conversations par mois
            $conversationsThisMonth = $this->recruiterConversations()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            
            return $conversationsThisMonth < 10;
        }

        return false;
    }

    /**
     * Retourne la limite de profils consultables par mois selon le plan recruteur.
     * null = illimité
     */
    public function getProfileViewLimit(): ?int
    {
        if ($this->role !== 'recruiter') return null;

        $plan = $this->recruiterPlan();

        return match ($plan) {
            'GRATUIT' => 5,
            'STANDARD' => 50,
            'PRO', 'ACADEMIE' => null, // Illimité
            default => 5,
        };
    }

    /**
     * Compte le nombre de profils uniques consultés ce mois-ci par ce recruteur.
     */
    public function monthlyProfileViewCount(): int
    {
        return \App\Models\ProfileView::where('viewer_id', $this->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->distinct('player_id')
            ->count('player_id');
    }

    /**
     * Vérifie si le recruteur peut encore consulter un profil ce mois-ci.
     */
    public function canViewProfile(int $playerId = null): bool
    {
        if ($this->role !== 'recruiter') return true; // Les joueurs et guardians peuvent voir sans limite

        $limit = $this->getProfileViewLimit();

        if ($limit === null) return true; // Illimité

        // Si le recruteur a déjà consulté ce profil ce mois-ci, ça ne compte pas comme nouveau
        if ($playerId) {
            $alreadyViewed = \App\Models\ProfileView::where('viewer_id', $this->id)
                ->where('player_id', $playerId)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->exists();

            if ($alreadyViewed) return true;
        }

        return $this->monthlyProfileViewCount() < $limit;
    }
}
