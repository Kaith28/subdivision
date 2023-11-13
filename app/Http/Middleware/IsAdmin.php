<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if not logged in
        if (!Auth::check()) {
            abort(response()->json([
                'message' => 'Please login.',
            ], 401));
        }

        // Check if not admin
        if (Auth::user()->role != "owner" && Auth::user()->role != "admin") {
            abort(404);
        }

        return $next($request);
    }
}
