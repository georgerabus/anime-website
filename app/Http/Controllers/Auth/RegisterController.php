<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

class RegisterController
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        //todo
    }

}
