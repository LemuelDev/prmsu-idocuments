<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->userProfile->user_type === 'student') {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}
