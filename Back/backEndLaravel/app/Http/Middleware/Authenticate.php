<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        dd(Auth::user());
        if (!Auth::check()) {
            return \response(status: 401);
        }

        return $next($request);
    }
}
