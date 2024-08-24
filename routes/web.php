<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\SuperadminController;

Route::get('/', [FrontController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::get('/movie/{slug}', [FrontController::class, 'detailMovie']);
Route::get('/series/{slug}', [FrontController::class, 'detailSeries']);


Route::middleware(['superadmin'])->group(function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('/beranda', [SuperadminController::class, 'beranda']);
        Route::get('/user', [SuperadminController::class, 'user']);
        Route::get('/user/add', [SuperadminController::class, 'user_add']);
        Route::post('/user/add', [SuperadminController::class, 'user_store']);
        Route::get('/user/delete/{id}', [SuperadminController::class, 'user_delete']);

        Route::get('/uri', [UriController::class, 'index']);
        Route::get('/genre', [GenreController::class, 'index']);
        Route::get('/country', [CountryController::class, 'index']);
        Route::get('/year', [YearController::class, 'index']);
        Route::get('/actor', [ActorController::class, 'index']);
        Route::get('/histats', [SuperadminController::class, 'histats']);
        Route::post('/histats', [SuperadminController::class, 'histats_update']);
        Route::get('/disquss', [SuperadminController::class, 'disquss']);
        Route::post('/disquss', [SuperadminController::class, 'disquss_update']);

        Route::get('/post', [PostController::class, 'index']);
        Route::get('/post/search', [PostController::class, 'search']);
        Route::get('/post/add', [PostController::class, 'add']);
        Route::post('/post/add', [PostController::class, 'scrap']);
        Route::get('/post/edit/{id}', [PostController::class, 'edit']);
        Route::post('/post/edit/{id}', [PostController::class, 'update']);
        Route::get('/post/delete/{id}', [PostController::class, 'delete']);
    });
});

Route::middleware(['anggota'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/beranda', [UserController::class, 'index']);
        Route::get('/gantipassword', [UserController::class, 'gantipass']);
        Route::post('/gantipassword', [UserController::class, 'update_pass']);
        Route::get('/post', [PostUserController::class, 'index']);
        Route::get('/post/search', [PostUserController::class, 'search']);
        Route::get('/post/add', [PostUserController::class, 'add']);
        Route::post('/post/add', [PostUserController::class, 'scrap']);
        Route::get('/post/edit/{id}', [PostUserController::class, 'edit']);
        Route::post('/post/edit/{id}', [PostUserController::class, 'update']);
        Route::get('/post/delete/{id}', [PostUserController::class, 'delete']);
    });
});
