<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }

    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('/shows')->group(function () {
    Route::get('/', [ShowsController::class, 'index'])->name('shows');

    Route::get('/create', [ShowsController::class, 'create'])->name('shows.create');

    Route::post('/', [ShowsController::class, 'store'])->name('shows.store');

    Route::get('/disponibilidade', [ShowsController::class, 'musicianAvailability'])->name('disponibilidade');

    Route::post('/disponibilidade', [ShowsController::class, 'setAvailability'])->name('set.disponibilidade');

    Route::get('/{id}', [ShowsController::class, 'show'])->name('shows.show');

    Route::post('/{id}', [ShowsController::class, 'update'])->name('shows.update');

    Route::delete('/{id}', [ShowsController::class, 'destroy'])->name('shows.destroy');
});

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users');

    Route::get('/create', [UserController::class, 'create'])->name('users.create');

    Route::post('/create', [UserController::class, 'store'])->name('users.store');

    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
