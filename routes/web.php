<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\IsMaster;
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

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('/shows')->group(function () {
        Route::get('/', [ShowsController::class, 'index'])->name('shows');

        Route::get('/disponibilidade', [ShowsController::class, 'musicianAvailability'])->name('disponibilidade');

        Route::post('/disponibilidade', [ShowsController::class, 'setAvailability'])->name('set.disponibilidade');

        Route::group(['middleware' => IsMaster::class], function () {
            Route::get('/create', [ShowsController::class, 'create'])->name('shows.create');

            Route::post('/', [ShowsController::class, 'store'])->name('shows.store');

            Route::get('/{id}', [ShowsController::class, 'show'])->name('shows.show');

            Route::post('/{id}', [ShowsController::class, 'update'])->name('shows.update');

            Route::delete('/{id}', [ShowsController::class, 'destroy'])->name('shows.destroy');
        });
    });

    Route::prefix('/users')->group(function () {
        Route::group(['middleware' => IsMaster::class], function () {

            Route::get('/', [UsersController::class, 'index'])->name('users');

            Route::get('/create', [UsersController::class, 'create'])->name('users.create');

            Route::post('/', [UsersController::class, 'store'])->name('users.store');

            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        });

        Route::get('/{id}', [UsersController::class, 'show'])->name('users.show');

        Route::post('/{id}', [UsersController::class, 'update'])->name('users.update');
    });
});
