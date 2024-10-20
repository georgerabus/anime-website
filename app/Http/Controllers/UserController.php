<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function uploadPhoto(Request $request)
    {
        $user = $request->user();
    
        // Check if a photo file is present in the request
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $path = $image->store('profile-photos', 'public');
    
            // Save the path of the uploaded original image to the user's profile
            $user->photo = $path;
            $user->save();
    
            return response()->json(['success' => true, 'url' => asset('storage/' . $path)]);
        }
    
        return response()->json(['success' => false], 400);
    }
    
    public function saveCroppedImage(Request $request)
    {
        $user = $request->user();
    
        // Only proceed if croppedImage is provided
        if ($request->hasFile('croppedImage')) {
    
            // Check if there is already an existing photo (from the original upload)
            if ($user->photo) {
                if (Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo); // Delete the original photo
                    Log::info('Old original photo deleted: ' . $user->photo);
                } else {
                    Log::warning('Original photo not found: ' . $user->photo);
                }
            }
    
            // Storing the new cropped photo
            $image = $request->file('croppedImage');
            $path = $image->store('profile-photos', 'public');
    
            // Update the user's profile with the new cropped photo path
            $user->photo = $path;
            $user->save();
    
            return response()->json(['success' => true, 'url' => asset('storage/' . $path)]);
        }
    
        return response()->json(['success' => false], 400);
    }
    
        
}


// public function saveCroppedImage(Request $request) {
//     $user = $request->user();

//     if ($request->hasFile('croppedImage')) {
//         if ($user->photo) {
//             // Check if the old photo exists and delete it
//             if (Storage::disk('public')->exists($user->photo)) {
//                 Storage::disk('public')->delete($user->photo);
//                 Log::info('Old photo deleted: ' . $user->photo);
//             } else {
//                 Log::warning('Photo not found: ' . $user->photo);
//             }

//             // Get the file extension of the original photo
//             $extension = pathinfo($user->photo, PATHINFO_EXTENSION);
//             $filename = pathinfo($user->photo, PATHINFO_FILENAME); // Get the filename without extension

//             // Save the cropped image with the same name and extension as the original
//             $path = $request->file('croppedImage')->storeAs('profile-photos', $filename . '.' . $extension, 'public');

//             $user->photo = $path; // Update user photo path
//             $user->save();

//             return response()->json(['success' => true, 'url' => asset('storage/' . $path)]);
//         }
//     }

//     return response()->json(['success' => false], 400);
// }

