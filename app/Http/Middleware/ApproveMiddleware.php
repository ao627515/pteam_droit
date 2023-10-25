<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (auth()->check()) {
            // Vérifie si l'utilisateur est un partenaire et est approuvé
            if (auth()->user()->isPartenaire() && auth()->user()->isApproved()) {
                return $next($request); // L'utilisateur est approuvé, poursuit la requête
            }
        }

        // Si l'utilisateur n'est pas approuvé, renvoie un message d'erreur
        return redirect()->back()->with('error', 'Vous n\'êtes pas encore approuvé par les administrateurs.');
    }

}
