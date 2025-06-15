<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class ValidarPermisoMiddleware
{
    public function handle($request, Closure $next, $ability)
    {
        $user = $request->user();
        dd($user);

        if ($user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return $next($request);
        }

        if ($user && $user->hasPermissionTo($ability)) {
            return $next($request);
        }

        return response()->json(['message' => 'Acceso denegado: permiso insuficiente'], Response::HTTP_FORBIDDEN);
    }
}
