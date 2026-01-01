<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RefreshSession
{
    /**
     * Handle an incoming request.
     * 
     * Refreshes the session on every request to prevent timeout
     * during active use. This extends the session expiration time.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Refresh session if user is logged in
        if (Session::has('user_id')) {
            // Touch the session to update last activity time
            // This extends the session expiration
            Session::put('last_activity', now()->timestamp);
        }

        return $next($request);
    }
}
