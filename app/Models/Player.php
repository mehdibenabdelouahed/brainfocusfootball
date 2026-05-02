<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'date_of_birth' => 'date',
        'profile_completed' => 'boolean',
        'goals' => 'array',
        'achievements' => 'array',
        'secondary_videos' => 'array',
        'photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function medicalData()
    {
        return $this->hasOne(MedicalData::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(Recruiter::class, 'favorite_players')->withTimestamps();
    }

    public function profileViews()
    {
        return $this->hasMany(ProfileView::class);
    }
}
