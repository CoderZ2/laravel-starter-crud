<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function signIn(LoginRequest $request)
    {
        $credentials = $request->safe()->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('inventory.index');
        }

        return back()->withErrors([
            'credentials' => 'The provided credentials do not match our records.',
        ])->withInput(['email']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('auth.login');
    }
}
