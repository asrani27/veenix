<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\UriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TvUserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\SuperadminController;

Route::get('/sitemap.xml', function () {
    $posts = Post::latest()->get(); // Ambil semua berita

    return Response::view('sitemap', compact('posts'))->header('Content-Type', 'application/xml');
});

Route::get('/', [FrontController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);
Route::get('/request', [FrontController::class, 'request']);
Route::get('/movie/{slug}', [FrontController::class, 'detailMovie']);
Route::get('/tv', [FrontController::class, 'tvSeries']);
Route::get('/tv/{slug}', [FrontController::class, 'detailTv']);
Route::get('/latest-movies', [FrontController::class, 'latestMovies']);
Route::get('/search', [FrontController::class, 'search']);
//Route::get('/series/{slug}', [FrontController::class, 'detailSeries']);
Route::get('/genre/{genre}', [FrontController::class, 'movieByGenre']);
Route::get('/country/{country}', [FrontController::class, 'movieByCountry']);
Route::get('/year/{year}', [FrontController::class, 'movieByYear']);
Route::get('/tv/{slug}/season-{season}/episode-{episode}', [FrontController::class, 'detailSeries']);


Route::middleware(['superadmin'])->group(function () {
    Route::prefix('superadmin')->group(function () {
        Route::post('/topmovie', [SuperadminController::class, 'topmovie']);
        Route::get('/topmovie/delete/{id}', [SuperadminController::class, 'deletetopmovie']);
        Route::get('/deadlinkvideo', [SuperadminController::class, 'deadlinkvideo']);
        Route::get('/deadlinkvideo/list', [SuperadminController::class, 'deadlinkvideo_list']);
        Route::get('/deadlinkvideo/list/search', [SuperadminController::class, 'deadlinkvideo_search']);
        Route::post('/deadlinkvideo/list/{id}', [SuperadminController::class, 'deadlinkvideo_update']);
        Route::get('/beranda', [SuperadminController::class, 'beranda']);
        Route::get('/user', [SuperadminController::class, 'user']);
        Route::get('/user/add', [SuperadminController::class, 'user_add']);
        Route::post('/user/add', [SuperadminController::class, 'user_store']);
        Route::get('/user/delete/{id}', [SuperadminController::class, 'user_delete']);

        Route::get('/gantipassword', [SuperadminController::class, 'gantipass']);
        Route::post('/gantipassword', [SuperadminController::class, 'update_pass']);

        Route::get('/uri', [UriController::class, 'index']);
        Route::get('/genre', [GenreController::class, 'index']);
        Route::get('/country', [CountryController::class, 'index']);
        Route::get('/year', [YearController::class, 'index']);
        Route::get('/actor', [ActorController::class, 'index']);
        Route::get('/histats', [SuperadminController::class, 'histats']);
        Route::post('/histats', [SuperadminController::class, 'histats_update']);
        Route::get('/logo', [SuperadminController::class, 'logo']);
        Route::post('/logo', [SuperadminController::class, 'logo_update']);
        Route::get('/disquss', [SuperadminController::class, 'disquss']);
        Route::post('/disquss', [SuperadminController::class, 'disquss_update']);

        Route::get('/post', [PostController::class, 'index']);
        Route::get('/post/search', [PostController::class, 'search']);
        Route::get('/post/add', [PostController::class, 'add']);
        Route::post('/post/add', [PostController::class, 'scrap']);
        Route::get('/post/create', [PostController::class, 'create']);
        Route::post('/post/create', [PostController::class, 'store']);
        Route::get('/post/edit/{id}', [PostController::class, 'edit']);
        Route::post('/post/edit/{id}', [PostController::class, 'update']);
        Route::get('/post/delete/{id}', [PostController::class, 'delete']);

        Route::get('/tv', [TvController::class, 'index']);
        Route::get('/tv/search', [TvController::class, 'search']);
        Route::get('/tv/episode/delete/{id}', [TvController::class, 'deleteEpisode']);
        Route::get('/tv/episode/edit/{id}', [TvController::class, 'editEpisode']);
        Route::post('/tv/episode/edit/{id}', [TvController::class, 'updateEpisode']);
        Route::get('/tv/episode/{id}', [TvController::class, 'episode']);
        Route::post('/tv/episode/{id}', [TvController::class, 'storeEpisode']);
        Route::get('/tv/add', [TvController::class, 'add']);
        Route::post('/tv/add', [TvController::class, 'scrap']);
        Route::get('/tv/edit/{id}', [TvController::class, 'edit']);
        Route::post('/tv/edit/{id}', [TvController::class, 'update']);
        Route::get('/tv/delete/{id}', [TvController::class, 'delete']);
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
        Route::get('/post/create', [PostUserController::class, 'create']);
        Route::post('/post/create', [PostUserController::class, 'store']);

        Route::get('/tv', [TvUserController::class, 'index']);
        Route::get('/tv/search', [TvUserController::class, 'search']);
        Route::get('/tv/episode/delete/{id}', [TvUserController::class, 'deleteEpisode']);
        Route::get('/tv/episode/edit/{id}', [TvUserController::class, 'editEpisode']);
        Route::post('/tv/episode/edit/{id}', [TvUserController::class, 'updateEpisode']);
        Route::get('/tv/episode/{id}', [TvUserController::class, 'episode']);
        Route::post('/tv/episode/{id}', [TvUserController::class, 'storeEpisode']);
        Route::get('/tv/add', [TvUserController::class, 'add']);
        Route::post('/tv/add', [TvUserController::class, 'scrap']);
        Route::get('/tv/edit/{id}', [TvUserController::class, 'edit']);
        Route::post('/tv/edit/{id}', [TvUserController::class, 'update']);
        Route::get('/tv/delete/{id}', [TvUserController::class, 'delete']);
    });
});
