<?php

use App\Http\Controllers\OddsApiController;
use Illuminate\Support\Facades\Route;

Route::get('odds-api', OddsApiController::class)->name('odds-api');
