<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // if ($request->user() && $request->user()->type !== 1) {
        //     // If user is not admin, handle unauthorized access
        //     return response()->json(['message' => 'Access denied. You do not have permission to access this resource.'], 403);
        // }

        // return $next($request);

         // Check if user is authenticated and is an admin (type 1)
        //  if (Auth::check() && Auth::user()->type === 1) {
        //     return $next($request);
        // }

        // // Unauthorized access: Logout user and return 403 response
        // Auth::logout();
        // return response()->json(['message' => 'Access denied.'], 403);
      
            if ($request->user() && $request->user()->type === 1) {
                return $next($request);
            }
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
}
