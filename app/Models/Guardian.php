<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'user_id',
        'player_id',
        'relation',
        'consent_given',
        'consent_date',
        'can_view_medical',
        'can_approve_contact',
    ];

    protected $casts = [
        'consent_given' => 'boolean',
        'can_view_medical' => 'boolean',
        'can_approve_contact' => 'boolean',
        'consent_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
