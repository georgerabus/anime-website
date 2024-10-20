<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/comments-store', [CommentController::class, 'store'])->name('comments-store');
    Route::post('/comments/reply/{id}', [CommentController::class, 'reply'])->name('comments-reply');
    
    Route::get('/profile', [UserController::class, 'showEditUser'])->name('user-profile');
    Route::put('/profile/update', [UserController::class, 'editUser'])->name('profile-update');
    
    Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
    Route::post('/save-cropped-image', [UserController::class, 'saveCroppedImage']);
});

// Public routes
Route::get('/', [AnimeController::class, 'index'])->name('home');
Route::get('/anime-list', [AnimeController::class, 'animeList'])->name('anime-list');
Route::get('/contact', [AnimeController::class, 'contact'])->name('contact');
Route::get('/search', [AnimeController::class, 'search'])->name('search');
// Route::get('/anime/{id}', [AnimeController::class, 'animePage'])->name('animePage');
Route::get('/anime', [AnimeController::class, 'animePage'])->name('animePage');