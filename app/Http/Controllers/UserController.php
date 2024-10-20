<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            'tempPhotoPath' => ['nullable', 'string'],
        ]);
    
        $user = $request->user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->tempPhotoPath) {
            $tempPath = str_replace(asset('storage/'), '', $request->tempPhotoPath);
            $permanentPath = 'profile-photos/' . basename($tempPath);  
    
            if (Storage::disk('public')->exists($tempPath)) {
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }
    
                Storage::disk('public')->move($tempPath, $permanentPath);
    
                $user->photo = $permanentPath;
            }
        }
    
        $user->save();
    
        $this->cleanUpTempFolder();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    
    private function cleanUpTempFolder()
    {
        $tempFolder = storage_path('app/public/temp-profile-photos');
    
        if (File::exists($tempFolder)) {
            $files = File::files($tempFolder);
    
            foreach ($files as $file) {
                if (File::exists($file)) {
                    File::delete($file);  
                }
            }
    
            File::deleteDirectory($tempFolder);
        }
    }
    

    public function uploadPhoto(Request $request)
    {
        $user = $request->user();
    
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $tempPath = $image->store('temp-profile-photos', 'public'); 
    
            return response()->json(['success' => true, 'url' => asset('storage/' . $tempPath)]);
        }
    
        return response()->json(['success' => false], 400);
    }
    
    
    public function saveCroppedImage(Request $request)
    {
        if ($request->hasFile('croppedImage')) {
            $image = $request->file('croppedImage');
            $tempCroppedPath = $image->store('temp-profile-photos', 'public'); 
    
            return response()->json(['success' => true, 'url' => asset('storage/' . $tempCroppedPath)]);
        }
    
        return response()->json(['success' => false], 400);
    }
    
        
}

