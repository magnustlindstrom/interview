<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\Teacher\AuthorLoginController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;

class MainAuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        if (!$user) return redirect()->back()->withErrors(['User was not found.']);

        return RedirectIfAuthenticated::handleDifferentUsers( $user );
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
