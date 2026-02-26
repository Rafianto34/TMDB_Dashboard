<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\MovieController;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('movies', MovieController::class);

Route::get('/sync-movies', [SyncController::class, 'syncMovies'])->name('sync.movies');
    