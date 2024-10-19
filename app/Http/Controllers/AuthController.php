<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

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
        Auth::logout();
        return redirect(route('home'))->with('success', 'Logged out successfully');
    }       

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request){

        // Doesnt work for some reason
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255'],
        //     'password' => ['required', 'string', 'min:3', 'confirmed']
        // ]);

        $request->validate([
            "username" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        try {
            if ($user->save()) {
                Auth::login($user);
                return redirect(route('home'))->with("success", "User created successfully!");
            }
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { 
                return redirect(route('home'))->with('error', 'The email or username has already been taken.');
            }
        }
}
}
