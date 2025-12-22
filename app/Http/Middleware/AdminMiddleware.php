<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if user is admin
        if (Session::get('user_role') !== 'admin') {
            return redirect()->route('feedback.index')->with('error', 'Access denied. Admin only.');
        }

        return $next($request);
    }
}
