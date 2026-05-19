<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * @param  array<int, string>  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        $role = $user?->role ?? 'student';

        if (!in_array($role, $roles, true)) {
            if ($request->expectsJson()) {
                abort(403);
            }

            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
