<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            "name" => "required",
            "password" => "required"
        ]);
        $credentials = $request->only("name", "password");
        if(Auth::attempt($credentials)){
            return redirect(route('home'))->with('success', 'Logged in successfully');
        }
        return redirect(route('home'))->with('error', 'Failed to log in');
    }

    public function logout(){
        Auth::logout();
        return redirect(route('home'))->with('success', 'Logged out successfully');
    }       

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        Log::info('User password after update: ' . $user->password);

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
