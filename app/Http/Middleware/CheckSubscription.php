<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    /**
     * Vérifie que le recruteur connecté dispose d'un plan suffisant.
     *
     * Usage dans les routes :
     *   ->middleware('subscription:STANDARD,PRO,ACADEMIE')
     *
     * @param string ...$allowedPlans  Plans autorisés (séparés par virgule dans la route)
     */
    public function handle(Request $request, Closure $next, string ...$allowedPlans): Response
    {
        $user = Auth::user();

        // Ce middleware ne s'applique qu'aux recruteurs
        if (!$user || !$user->isRecruiter()) {
            return $next($request);
        }

        $currentPlan = $user->recruiterPlan();

        if (!in_array($currentPlan, $allowedPlans)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cette fonctionnalité nécessite un abonnement supérieur.',
                    'redirect' => route('pricing'),
                ], 403);
            }

            return redirect()->route('upgrade.required')->with('error',
                'Cette fonctionnalité est réservée aux plans ' . implode(', ', $allowedPlans) . '. ' .
                'Votre plan actuel : ' . $currentPlan . '.'
            );
        }

        return $next($request);
    }
}
