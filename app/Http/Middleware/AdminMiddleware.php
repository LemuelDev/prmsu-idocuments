<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->userProfile->user_type === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
