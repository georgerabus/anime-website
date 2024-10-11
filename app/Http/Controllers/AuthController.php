<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        //todo
    }

    public function logout(Request $request){
        //todo
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        //todo
    }
}
