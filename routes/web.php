<?php

use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/currencies/exchange', CurrencyExchangeController::class);
