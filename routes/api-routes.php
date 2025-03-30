<?php

use App\Http\Controllers\BasketballOddsController;
use Illuminate\Support\Facades\Route;

Route::get('odds-api', BasketballOddsController::class)->name('odds-api');
