<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAccess
{
    public function handle($request, Closure $next)
    {
        if (true) {
            return \response(status: 401);
        }

        return $next($request);
    }
}
