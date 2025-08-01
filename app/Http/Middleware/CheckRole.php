<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
       
        //dd($role);
        if (!Auth::check() || !Auth::user()->role || Auth::user()->role->name !== $role) {
            dd($role);
            abort(403, 'Unauthorized action.');
            
        }

        return $next($request);
    }
}

