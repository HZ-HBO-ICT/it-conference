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
        $user = optional(Auth::user());

        if (!Edition::current()) {
            if ($user->hasRole('event organizer')) {
                return redirect(route('moderator.editions.index'))
                    ->dangerBanner("There is no edition. You should activate one to access this page.");
            }

            if ($user->is_crew) {
                return redirect(route('dashboard'))
                    ->dangetButton("There is no active edition. You can't access this page for now.");
            }
        }

        return $next($request);
    }
}
