<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Vérifie que l'utilisateur connecté possède un des rôles autorisés.
     *
     * Usage dans les routes :
     *   ->middleware('role:recruiter,player')
     *
     * @param string ...$roles  Rôles autorisés
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Vous n\'avez pas le rôle requis pour accéder à cette page.',
                ], 403);
            }

            abort(403, 'Vous n\'avez pas le rôle requis pour accéder à cette page.');
        }

        return $next($request);
    }
}
