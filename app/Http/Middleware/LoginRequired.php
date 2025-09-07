<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginRequired
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->get('login')) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}