<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;

// Route::view('/', 'welcome')->name('home');

Route::get('/', [
    App\Http\Controllers\PageController::class, 'home'
]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::resource('repositories', RepositoryController::class)
    ->middleware('auth');

require __DIR__.'/settings.php';
