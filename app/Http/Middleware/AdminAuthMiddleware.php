<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // dd(route('auth#loginPage'));
        // dd(url()->current());

        // if(!empty(Auth::user())) {
        //     if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage') ) {
        //         return back();
        //     }

            if(Auth::user()->role == 'user') {
                abort(404);
            }
            
            return $next($request);
        // }




    }
}
