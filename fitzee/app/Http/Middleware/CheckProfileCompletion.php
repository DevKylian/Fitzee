<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            if (!auth()->user()->profile->isComplete()) {
                return redirect()->route('my-profile')->with('info', 'Votre profil n\'est pas complet. Veuillez le compléter pour accéder a l\'entiereté de l\'application.');
            }
        }

        return $next($request);
    }
}
