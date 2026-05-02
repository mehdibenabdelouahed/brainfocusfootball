<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $fillable = [
        'user_id',
        'org_name',
        'license_number',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritePlayers()
    {
        return $this->belongsToMany(Player::class, 'favorite_players')->withTimestamps();
    }
}
