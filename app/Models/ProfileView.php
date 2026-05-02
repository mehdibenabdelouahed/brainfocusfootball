<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{
    protected $table = 'profile_views';

    protected $fillable = [
        'player_id',
        'viewer_id',
        'viewer_role',
        'ip_address',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function viewer()
    {
        return $this->belongsTo(User::class, 'viewer_id');
    }
}
