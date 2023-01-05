<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Providers\RouteServiceProvider;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return self::handleDifferentUsers( Auth::user() );
            }
        }

        return $next($request);
    }

    public static function handleDifferentUsers($user)
    {
        if ($user->hasRole(User::ROLE_STUDENT)) return redirect()->route('student.home');
        if ($user->hasRole(User::ROLE_AUTHOR)) return redirect(config('nova.path'));

        Auth::guard('backpack')->login( $user );
        return redirect()->route('backpack.dashboard');
    }
}
