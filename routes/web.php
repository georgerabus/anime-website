<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/', [AnimeController::class, 'index'])->name('home');

Route::get('/anime-list', [AnimeController::class, 'animeList'])->name('anime-list');

Route::get('/contact', [AnimeController::class, 'contact'])->name('contact');

Route::get('/search', [AnimeController::class, 'search'])->name('search');

//for now
Route::get('/anime', [AnimeController::class, 'animePage'])->name('animePage');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/comments-store', [CommentController::class, 'store'])->name(('comments-store'))->middleware('auth');
Route::post('/comments/reply/{id}', [CommentController::class, 'reply'])->name('comments-reply')->middleware('auth');


Route::get('/profile', [UserController::class, 'editUser'])->name('user-profile')->middleware('auth');
