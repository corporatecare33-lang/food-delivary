<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RiderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access rider dashboard.');
        }

        $user = auth()->user();

        // Check if user has rider role
        if (!$user->isRider()) {
            return redirect('/')->with('error', 'You do not have permission to access the rider dashboard.');
        }

        // Check if rider record exists
        if (!$user->rider) {
            return redirect('/')->with('error', 'Rider profile not found. Please contact support.');
        }

        return $next($request);
    }
}

