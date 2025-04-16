<?php

use App\Http\Controllers\Api\OddsController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('odds/{sport}', OddsController::class)->name('odds');
});
