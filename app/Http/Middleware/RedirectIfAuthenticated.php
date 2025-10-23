<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guard = $guards[0] ?? null;

        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role == '0') {
                return redirect()->route('backend.beranda'); // admin
            } elseif ($role == '1') {
                return redirect()->route('user.dashboard'); // user biasa
            } else {
                return redirect()->route('backend.beranda');
            }
        }

        return $next($request);
    }
}
