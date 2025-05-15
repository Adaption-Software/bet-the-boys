<?php

use App\Http\Controllers\Api\OddsController;
use App\Http\Controllers\Api\PlaceBetController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->middleware('web')->group(function () {
    Route::get('odds/{sport}', OddsController::class)->name('odds');

    Route::post('place-bet', PlaceBetController::class)
        ->name('place-bet');
});
