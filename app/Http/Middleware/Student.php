<?php

namespace App\Http\Middleware;

use App\Models\StudentEnroll;
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
        // $student = StudentEnroll::check();
        // if ($student) {


        //     if ($student->student_email  == $request->student_email) {
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
