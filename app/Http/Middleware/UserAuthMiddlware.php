<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddlware
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'admin') {
            abort(404);
        }
        return $next($request);

    }
}
