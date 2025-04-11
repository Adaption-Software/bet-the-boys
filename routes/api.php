<?php

use App\Http\Controllers\BasketballOddsController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('odds', BasketballOddsController::class)->name('odds');
});
