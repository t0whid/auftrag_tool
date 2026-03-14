<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! in_array($user->role, ['super_admin', 'admin'])) {
            abort(403);
        }

        if (! $user->status) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['username' => __('auth.inactive')]);
        }

        return $next($request);
    }
}