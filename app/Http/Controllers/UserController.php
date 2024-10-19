<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserController
{
    public function showEditUser(){
        return view('pages.profile');
    }

    public function editUser(Request $request){

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

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function uploadPhoto(Request $request){

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $path = $image->store('profile-photos', 'public');

            // Return the image URL so it can be displayed
            return response()->json(['success' => true, 'url' => asset('storage/' . $path)]);
        }

        return response()->json(['success' => false], 400);
    }

    public function saveCroppedImage(Request $request){

        $user = $request->user();

        if ($request->hasFile('croppedImage')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $image = $request->file('croppedImage');
            $path = $image->store('profile-photos', 'public');

            $user->photo = $path;
            $user->save();

        return response()->json(['success' => true, 'url' => asset('storage/' . $path)]);
        }

    return response()->json(['success' => false], 400);
}

}
