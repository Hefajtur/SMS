<?php

namespace App\Http\Middleware\adminpanel;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(! Auth::check()) {
            return redirect()->route('login');
        }

        if(Auth::user()->role == 1) {
            return redirect()->route('adminpanel.superAdmin');
        }
        
        if(Auth::user()->role == 2) {
            return redirect()->route('adminpanel.admin');
        }
        
        if(Auth::user()->role == 3) {
            return $next($request);
        }

        if(Auth::user()->role == 4) {
            return redirect()->route('adminpanel.student');
        }

        if(Auth::user()->role == 5) {
            return redirect()->route('adminpanel.parent');
        }

        if(Auth::user()->role == 6) {
            return redirect()->route('adminpanel.user');
        }
    }
}
