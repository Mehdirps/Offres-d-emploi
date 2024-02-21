<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

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

            // Obtenir l'utilisateur actuellement connecté
            $user = Auth::user();

            // Vérifier le rôle de l'utilisateur et rediriger en conséquence
            if ($user->role == 'entreprise') {
                return redirect()->intended('dashboard');
            } else if ($user->role == 'candidat') {
                return redirect()->intended('/');
            }
        } else {
            return back()->withErrors([
                'email' => 'E-mail invalide'
            ])->onlyInput('email');
        }
    }

    public function registerCompany()
    {
        return view('auth/register');
    }

    public function doRegisterCompany(CompanyRegisterRequest $requestCompany, UserRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->last_name . ' ' . $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'entreprise';
        $user->save();

        Auth::login($user);

        $company = new Company();
        $company->company_name = $requestCompany->company_name;
        $company->slug = Str::slug($request->company_name, '-');
        $company->activity = $requestCompany->activity;
        $company->company_email = $requestCompany->company_email;
        $company->company_phone = $requestCompany->company_phone;
        $company->address = $requestCompany->address;
        $company->postal_code = $requestCompany->postal_code;
        $company->city = $requestCompany->city;
        $company->website = $requestCompany->website;
        $company->user_id = $user->id;
        $company->save();

        return redirect()->route('dashboard')->with('success', 'Inscription réussie, vous avez été automatiquement connecté. Vous pouvez maintenant gérer votre entreprise et vos offres d\'emploi.');
    }

    public function registerUser()
    {
        return view('auth/register_user');
    }

    public function doRegisterUser(UserRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->last_name . ' ' . $request->first_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = 'candidat';
        $user->save();

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Inscription réussie, vous avez été automatiquement connecté. Vous pouvez maintenant consulté et posuler à des offres d\'emploi.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

}
