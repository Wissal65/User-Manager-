<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
    
            if ($request->user() && $request->user()->type === 1) {
                return $next($request);
            }
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
}
