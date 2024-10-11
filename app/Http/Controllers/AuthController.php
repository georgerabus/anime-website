<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials)){
            return redirect(route('home'))->with('success', 'Logged in successfully');
        }
        return redirect(route('home'))->with('error', 'Failed to log in');
    }

    public function logout(Request $request){
        //todo
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            "username" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            return redirect(route('home'))->with("success", "User created successfully!");
        }
        return redirect(route('register'))->with("error", "Failed to create user.");

    }
}
