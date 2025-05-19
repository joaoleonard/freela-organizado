<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RestaurantsController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\ShowsRestaurantController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WaitListController;
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

Route::get('/join-waitinglist', [WaitListController::class, 'create']);

Route::post('/join-waitinglist', [WaitListController::class, 'store'])->name('join-waitinglist');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('/shows')->group(function () {
        Route::get('/', [ShowsController::class, 'index'])->name('shows');

        Route::get('/disponibilidade', [ShowsController::class, 'musicianAvailability'])->name('disponibilidade');

        Route::post('/disponibilidade', [ShowsController::class, 'setAvailability'])->name('set.disponibilidade');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');

        Route::group(['middleware' => IsMaster::class], function () {
            Route::get('/create', [UsersController::class, 'create'])->name('users.create');

            Route::post('/', [UsersController::class, 'store'])->name('users.store');

            Route::delete('/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        });

        Route::get('/{user}', [UsersController::class, 'show'])->name('users.show');

        Route::put('/{user}', [UsersController::class, 'update'])->name('users.update');
    });

    Route::prefix('/waitlist')->group(function () {
        Route::group(['middleware' => IsMaster::class], function () {
            Route::get('/', [WaitListController::class, 'index'])->name('waitlist');

            Route::get('/{musicianWaitlist}', [WaitListController::class, 'show'])->name('waitlist.show');

            Route::put('/{musicianWaitlist}', [WaitListController::class, 'update'])->name('waitlist.update');

            Route::delete('/{musicianWaitlist}', [WaitListController::class, 'destroy'])->name('waitlist.destroy');
        });
    });

    Route::prefix('/restaurants')->group(function () {
        Route::get('/', [RestaurantsController::class, 'index'])->name('restaurants');

        Route::get('/create', [RestaurantsController::class, 'create'])->name('restaurants.create');

        Route::post('/', [RestaurantsController::class, 'store'])->name('restaurants.store');

        Route::prefix('/{restaurant}')->group(function () {
            Route::get('/', [RestaurantsController::class, 'show'])->name('restaurant.show');

            Route::put('/', [RestaurantsController::class, 'update'])->name('restaurant.update');

            Route::delete('/', [RestaurantsController::class, 'destroy'])->name('restaurant.destroy');

            Route::prefix('/shows')->group(function () {
                Route::get('/', [ShowsRestaurantController::class, 'index'])->name('restaurant.shows');

                Route::get('/create', [ShowsRestaurantController::class, 'create'])->name('restaurant.shows.create');

                Route::post('/', [ShowsRestaurantController::class, 'store'])->name('restaurant.shows.store');

                Route::get('/{show}', [ShowsRestaurantController::class, 'show'])->name('restaurant.shows.show');

                Route::put('/{show}', [ShowsRestaurantController::class, 'update'])->name('restaurant.shows.update');

                Route::delete('/{show}', [ShowsRestaurantController::class, 'destroy'])->name('restaurant.shows.destroy');
            });

            Route::prefix('/users')->group(function () {
                Route::get('/', [RestaurantsController::class, 'musicians'])->name('restaurant.musicians');

                Route::get('/link', [RestaurantsController::class, 'addMusician'])->name('restaurant.musicians.add');

                Route::post('/link', [RestaurantsController::class, 'linkMusician'])->name('restaurant.musicians.link');

                Route::get('/{musician}', [RestaurantsController::class, 'showMusician'])->name('restaurant.musicians.show');

                Route::delete('/{musician}', [RestaurantsController::class, 'unlinkMusician'])->name('restaurant.musicians.remove');
            });
        });
    });
});
