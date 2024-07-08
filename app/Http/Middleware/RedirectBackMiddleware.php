<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RedirectBackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            $currentUrl = $request->path();
            if ($userRole === 'admin' && strpos($currentUrl, 'user') !== false) {
                // Admin trying to access user URLs, redirect back
                return new RedirectResponse(url()->previous());
            }
            if ($userRole !== 'admin' && strpos($currentUrl, 'admin') !== false) {
                // User trying to access admin URLs, redirect back
                return new RedirectResponse(url()->previous());
            }

        }
        return $next($request);
    }
}
