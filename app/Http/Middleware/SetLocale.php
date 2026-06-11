<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Langues supportées par la plateforme.
     */
    protected array $supportedLocales = ['fr', 'en', 'nl'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale', config('app.locale', 'fr'));

        if (!in_array($locale, $this->supportedLocales)) {
            $locale = config('app.locale', 'fr');
        }

        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);

        // Remove locale from route parameters so controllers don't receive it
        $request->route()->forgetParameter('locale');

        return $next($request);
    }
}
