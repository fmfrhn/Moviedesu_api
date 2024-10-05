<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WatchlistController;

Route::post('/login', [LoginController::class, 'login'] );
Route::post('/register', [RegisterController::class, 'register'] );
Route::get('/search_movies', [MovieController::class, 'search']);
Route::get('/movies', [MovieController::class, 'detail']);

Route::get('/show_watchlist', [WatchlistController::class, 'showWatchlist']);
Route::post('/add_watchlist', [WatchlistController::class, 'addWatchlist']);
Route::delete('/delete_watchlist/{imdb_id}', [WatchlistController::class, 'deleteWatchlist']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
