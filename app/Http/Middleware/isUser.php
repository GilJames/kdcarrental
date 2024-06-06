<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isUser
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
        if (Auth::check() && Auth::user()->banned_at !== null) {
            Auth::logout(); // Log the user out
            return redirect('/')->with('error', 'Your account is banned. Please contact support.');
        }
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }
    }
}
