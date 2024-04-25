<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (!empty(Auth::check())) {


        //     if (Auth::user()->role == 3) {
                return $next($request);
        //     } else {
        //         Auth::logout();
        //         return redirect()->route('login')->with('error', 'You do not have permission to access this page.');
        //     }
        // } else {
        //     Auth::logout();
        //     return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        // }
    }
}
