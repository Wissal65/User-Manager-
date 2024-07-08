<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): Response
    // {
    //     $request->authenticate();
    //     if (Auth::user()->type !== 1) {
    //         Auth::logout();
    //         return response()->json(['message' => 'Access denied.......'], 403);
            
    //     }

    //     $request->session()->regenerate();

    //     return response()->noContent();
    // }
    public function store(LoginRequest $request): Response
    {
        try {
            $request->authenticate();

            if (Auth::user()->type !== 1) {
                Auth::logout();
                return new Response(['message' => 'Access denied.'], 403);
            }

            $request->session()->regenerate();

            return new Response(null, 204);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return new Response(['message' => 'Internal Server Error.'], 500);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
