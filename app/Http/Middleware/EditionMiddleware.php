<?php

namespace App\Http\Middleware;

use App\Models\Edition;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            return redirect(route('login'));
        }

        if (!Auth::user()->is_crew) {
            abort(403);
        }

        if (!Edition::current()) {
            return redirect(route('moderator.editions.index'))
                ->banner("There is no active edition. You can't access this page for now.");
        }

        return $next($request);
    }
}
