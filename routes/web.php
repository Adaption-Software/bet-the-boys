<?php

use App\Http\Controllers\BasketballEventsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FootballController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => Redirect::route('login'));

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')
    ->prefix('sport')
    ->group(function () {
        Route::resource('basketball', BasketballEventsController::class)
            ->only('index');

        Route::resource('football', FootballController::class)->only('index');
    });

require __DIR__.'/auth.php';
