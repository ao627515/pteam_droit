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
        /** @var App\Model\User $user */
        $user = auth()->user();

        if (!$user->isApprove() and  $request->route()->getName() != 'user.show') {
            return to_route('user.show', $user)->with('error', 'Vous n\'êtes pas encore approuvé par les administrateurs.');
        }

        return $next($request);
    }
}
