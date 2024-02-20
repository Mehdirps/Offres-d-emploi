<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'E-mail invalide'
            ])->onlyInput('email');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

}
