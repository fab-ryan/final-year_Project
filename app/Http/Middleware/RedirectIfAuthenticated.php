<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guard = empty($guard) ? [null] : $guard;
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }
        foreach ($guard as $guard) {

            if (Auth::guard($guard)->check() && Auth::user()->role == 'academic') {
                return redirect()->route('academic.dashboard');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role == 'hod') {
                return \redirect()->route('hod.dashboard');
            }
            elseif (Auth::guard($guard)->check() && Auth::user()->role == 'lecture') {
                return \redirect()->route('lecture.dashboard');
            }
            elseif (Auth::guard($guard)->check() && Auth::user()->role == 'student') {
                return \redirect()->route('student.dashboard');
            }
            else {
                return $next($request);
            }
        }
    }
}
