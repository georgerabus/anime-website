<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserController
{
    public function showEditUser(){
        return view('pages.profile');
    }

    public function editUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'password' => ['nullable', 'string', 'min:3', 'confirmed'],  
            'photo' => ['nullable', 'image', 'max:2048'],  
        ]);

        $user = $request->user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($request->password);
     
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public'); 
            $user->photo = $path; 
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
