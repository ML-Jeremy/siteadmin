<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $type): Response
    {
        $user = Auth::user();

        if ($user && $user->type == $type) {
            return $next($request);
        }

        // Redirection ou réponse en cas d'accès non autorisé
        //return redirect('/login');
        return response('Unauthorized', 403);
    }
}
