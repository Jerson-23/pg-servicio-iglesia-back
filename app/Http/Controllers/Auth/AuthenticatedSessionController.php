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
    public function store(LoginRequest $request)
    {
        $token = $request->authenticate();

        if ($token) {
            // MODO Token: Retorna JSON con el token
            return response()->json([
                'token' => $token,
                'message' => 'Autenticación exitosa',
            ]);
        }

        // MODO Sesión: Regenera sesión y retorna 204
        $request->session()->regenerate();

        return response()->noContent();
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
