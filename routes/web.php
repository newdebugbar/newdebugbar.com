<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ValidateSignature;
use App\Http\Controllers\Subscribers\ConfirmController;

Route::view('/', 'home')->name('home');

Route::middleware(ValidateSignature::class)
    ->get('/confirm/{subscriber}', ConfirmController::class)
    ->name('confirm-subscriber');
