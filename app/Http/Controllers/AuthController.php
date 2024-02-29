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
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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

            $user = Auth::user();

            if (!$user->email_verified_at) {
               /* Auth::logout();*/
                return redirect()->route('home')->with('error', 'Veuillez vérifier votre adresse e-mail avant d\'accéder à votre espace, vérifier dans votre boite e-mail ou dans les spams.');
            }

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

        try {

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'ssl0.ovh.net';
            $mail->Port = '465';
            $mail->isHTML(true);
            $mail->Username = "contact@maplaque-nfc.fr";
            $mail->Password = "3v;jcPFeUPMBCP9";
            $mail->SetFrom("contact@maplaque-nfc.fr", "MonOffreD'emploi.fr");
            $mail->Subject = 'Merci pour votre inscription !';
            $mail->Body = '
            <h1>Bienvenue sur notre site web</h1>
           <p>Merci de vous être inscrit sur notre site web. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail et compléter votre inscription :</p>
           <p>
                <a href="' . url('/verify_email/' . $user->email) . '">Vérifier l\'Email</a>
           </p>
           <p>Si vous ne vous êtes pas inscrit sur notre site web, veuillez ignorer cet email.</p>
           <p>Meilleures salutations,</p>
           <p>L\'équipe de votre site web</p>';
            $mail->AddAddress($user->email);

            $mail->send();

            echo 'Message has been sent';

        } catch (Exception $e) {

            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        }

        Auth::login($user);

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

        try {

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'ssl0.ovh.net';
            $mail->Port = '465';
            $mail->isHTML(true);
            $mail->Username = "contact@maplaque-nfc.fr";
            $mail->Password = "3v;jcPFeUPMBCP9";
            $mail->SetFrom("contact@maplaque-nfc.fr", "MonOffreD'emploi.fr");
            $mail->Subject = 'Merci pour votre inscription !';
            $mail->Body = '
            <h1>Bienvenue sur notre site web</h1>
           <p>Merci de vous être inscrit sur notre site web. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail et compléter votre inscription :</p>
           <p>
              <a href="' . url('/verify_email/' . $user->email) . '">Vérifier l\'Email</a>
           </p>
           <p>Si vous ne vous êtes pas inscrit sur notre site web, veuillez ignorer cet email.</p>
           <p>Meilleures salutations,</p>
           <p>L\'équipe de votre site web</p>';
            $mail->AddAddress($user->email);

            $mail->send();

            echo 'Message has been sent';

        } catch (Exception $e) {

            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

        }

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Inscription réussie, vous avez été automatiquement connecté. Vous pouvez maintenant consulté et posuler à des offres d\'emploi.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function verify($email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            if ($user->role === 'entreprise') {
                return redirect()->route('dashboard')->with('success', 'Votre adresse e-mail a été vérifiée avec succès.');
            } else if ($user->role === 'candidat') {
                return redirect()->route('home')->with('success', 'Votre adresse e-mail a été vérifiée avec succès.');
            }
        } else {
            return redirect()->route('home')->with('error', 'L\'adresse e-mail n\'a pas pu être vérifiée.');
        }
    }

}
