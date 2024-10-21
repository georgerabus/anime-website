<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EpisodeController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('anime/{anime_id}/comments', [CommentController::class, 'store'])->name('comments-store');
    Route::post('/comments/reply/{id}', [CommentController::class, 'reply'])->name('comments-reply');
    
    Route::get('/profile', [UserController::class, 'showEditUser'])->name('user-profile');
    Route::put('/profile/update', [UserController::class, 'editUser'])->name('profile-update');
    
    Route::post('/upload-photo', [UserController::class, 'uploadPhoto']);
    Route::post('/save-cropped-image', [UserController::class, 'saveCroppedImage']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('adminPage');
    Route::get('/admin/add', [AdminController::class, 'addNew'])->name('adminAddNew');
    Route::get('/admin/list', [AdminController::class, 'list'])->name('adminList');
    Route::get('/admin/list/{id}', [AdminController::class, 'listEpisodes'])->name('adminListEpisodes');

    Route::get('/anime/{id}/edit', [AnimeController::class, 'edit'])->name('editAnime');
    Route::post('/anime/{id}', [AnimeController::class, 'update'])->name('updateAnime');
    Route::delete('/anime/{id}', [AnimeController::class, 'destroy'])->name('deleteAnime');
    
    
    Route::post('/admin/anime', [AdminController::class, 'storeAnime'])->middleware('admin')->name('storeAnime');
    Route::post('/admin/episode', [AdminController::class, 'storeEpisode'])->middleware('admin')->name('storeEpisode');

    Route::get('/anime/{id}/episodes/{episode_id}/edit', [EpisodeController::class, 'editEpisode'])->name('editEpisode');
    Route::post('/anime/{id}/episodes/{episode_id}/edit', [EpisodeController::class, 'updateEpisode'])->name('updateEpisode');
    Route::delete('/anime/{id}/episodes/{episode_id}', [EpisodeController::class, 'deleteEpisode'])->name('deleteEpisode');
    Route::post('/anime/{id}/episodes/rename', [EpisodeController::class, 'renameEpisodeId'])->name('renameEpisodeId');


    Route::get('/admin/users', [AdminController::class, 'editUser'])->name('adminEditUser');
    
});

// Public routes
Route::get('/', [AnimeController::class, 'index'])->name('home');
Route::get('/contact', [AnimeController::class, 'contact'])->name('contact');
Route::get('/search', [AnimeController::class, 'search'])->name('search');
Route::get('anime/{id}/episode/{episode_id?}', [AnimeController::class, 'animePage'])->name('animePage');