<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [AnimeController::class, 'index'])->name('home');

Route::get('/anime-list', [AnimeController::class, 'animeList'])->name('anime-list');

Route::get('/contact', [AnimeController::class, 'contact'])->name('contact');

Route::get('/search', [AnimeController::class, 'search'])->name('search');

//for now
Route::get('/anime', [AnimeController::class, 'animePage'])->name('animePage');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
