<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function approveConsent(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'guardian') {
            return redirect()->back()->withErrors(['error' => 'Accès non autorisé.']);
        }

        $request->validate([
            'consent' => 'required|accepted',
        ]);

        $guardian = $user->guardian;

        if ($guardian) {
            $guardian->update([
                'consent_given' => true,
                'consent_date' => now(),
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Consentement enregistré avec succès. Le profil de votre enfant peut désormais être publié.');
    }
}
