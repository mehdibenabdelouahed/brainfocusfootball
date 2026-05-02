<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function pricing()
    {
        return view('pricing.index');
    }

    public function checkout(Request $request)
    {
        $plan = $request->query('plan');
        $validPlans = ['PREMIUM', 'STANDARD', 'PRO', 'ACADEMIE'];

        if (!in_array($plan, $validPlans)) {
            return redirect()->route('pricing')->with('error', 'Plan invalide.');
        }

        return view('pricing.checkout', compact('plan'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:PREMIUM,STANDARD,PRO,ACADEMIE',
            'card_name' => 'required|string',
            'card_number' => 'required|string', // Simulation
        ]);

        $user = Auth::user();

        // Désactiver l'ancien abonnement
        if ($user->activeSubscription) {
            $user->activeSubscription->update(['status' => 'canceled']);
        }

        // Créer le nouvel abonnement
        Subscription::create([
            'user_id' => $user->id,
            'plan_name' => $request->plan,
            'status' => 'active',
            'ends_at' => now()->addMonth(), // Validité d'un mois
        ]);

        return redirect()->route('dashboard')->with('success', 'Paiement réussi ! Vous avez maintenant accès au plan ' . $request->plan . '.');
    }
}
