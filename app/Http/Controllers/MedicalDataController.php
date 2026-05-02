<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalDataController extends Controller
{
    private function getAuthorizedPlayer()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user->isPlayer()) {
            return $user->player;
        } elseif ($user->isGuardian()) {
            return $user->guardian->player;
        }
        abort(403, 'Accès non autorisé à l\'espace médical.');
    }

    public function edit()
    {
        $player = $this->getAuthorizedPlayer();
        
        // Créer ou récupérer les données médicales existantes
        $medicalData = \App\Models\MedicalData::firstOrCreate(
            ['player_id' => $player->id]
        );

        return view('medical.edit', compact('medicalData', 'player'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $player = $this->getAuthorizedPlayer();
        $medicalData = \App\Models\MedicalData::firstOrCreate(['player_id' => $player->id]);

        $validated = $request->validate([
            'blood_type_enc' => 'nullable|string|max:10',
            'allergies_encrypted' => 'nullable|string',
            'injuries_history_enc' => 'nullable|string',
            'access_restricted' => 'boolean',
        ]);

        $medicalData->update([
            'blood_type_enc' => $validated['blood_type_enc'] ?? null,
            'allergies_encrypted' => $validated['allergies_encrypted'] ?? null,
            'injuries_history_enc' => $validated['injuries_history_enc'] ?? null,
            'access_restricted' => $request->has('access_restricted') ? $request->boolean('access_restricted') : true,
        ]);

        return back()->with('success', 'Les données médicales sécurisées ont été mises à jour.');
    }
}
