<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if (auth()->attempt($login)) {
            $token = auth()->user()->createToken('Token')->accessToken;
            return redirect('/student')->with('message', 'Logged In!');
        }


        return redirect()->back()->withInput()->with('error', 'Invlaid credentials!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/')->with('message', 'Logged out!');
    }
}
