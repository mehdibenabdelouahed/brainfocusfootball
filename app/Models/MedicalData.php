<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalData extends Model
{
    protected $table = 'medical_data';

    protected $fillable = [
        'player_id',
        'allergies_encrypted',
        'injuries_history_enc',
        'blood_type_enc',
        'access_restricted',
    ];

    protected $casts = [
        'allergies_encrypted' => 'encrypted',
        'injuries_history_enc' => 'encrypted',
        'blood_type_enc' => 'encrypted',
        'access_restricted' => 'boolean',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
