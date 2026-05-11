<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $roles = [
            0 => 'admin',
            1 => 'vendor',
            2 => 'customer',
        ];


        $userRole = $roles[Auth::user()->role] ?? null;
        if ($userRole === $role) {
            return $next($request);
        }

        abort(403);
    }
}
