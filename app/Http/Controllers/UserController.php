<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function single($id)
    {
        $user = User::find($id);
        $apply = $user->apply;

        if(!$user->email_verified_at){
            return redirect()->route('home')->with('error', 'Veuillez vérifier votre adresse e-mail avant d\'accéder à votre espace, vérifier dans votre boite e-mail ou dans les spams.');
        }

        $conversations = Conversation::where('user_id', auth()->id())->get();

        return view('user.single', [
            'user' => $user,
            'apply' => $apply,
            'conversations' => $conversations
        ]);
    }
}
