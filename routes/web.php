<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimeController;

Route::get('/', [AnimeController::class, 'index'])->name('home');

Route::get('/anime-list', [AnimeController::class, 'animeList'])->name('anime-list');

Route::get('/contact', [AnimeController::class, 'contact'])->name('contact');

Route::get('/search', [AnimeController::class, 'search'])->name('search');

//for now
Route::get('/anime', [AnimeController::class, 'animePage'])->name('animePage');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
