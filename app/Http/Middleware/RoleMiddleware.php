<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
        public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array(strtolower($user->role), array_map('strtolower', $roles))) {
            abort(403, 'Kamu tidak punya izin mengakses halaman ini.');
        }

        return $next($request);
    }

}
