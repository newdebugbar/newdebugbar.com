<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Routing\Middleware\ValidateSignature;
use App\Http\Controllers\Subscribers\ConfirmController;

Route::get('/', HomeController::class)->name('home');
Route::view('/foo', 'foo');

Route::middleware(ValidateSignature::class)
    ->get('/confirm/{subscriber:email}', ConfirmController::class)
    ->name('confirm-subscriber');
