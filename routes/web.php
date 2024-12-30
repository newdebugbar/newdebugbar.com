<?php

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Notifications\Subscribers\Confirm;
use Illuminate\Routing\Middleware\ValidateSignature;
use App\Http\Controllers\Subscribers\ConfirmController;

Route::get('/', HomeController::class)->name('home');

if (app()->isLocal()) {
    Route::get('/benchmark', function () {
        cache()->put('foo', 'bar');
        cache()->put('baz', 'qux', 3600);

        Subscriber::query()->first()->notify(new Confirm);

        User::query()->get();

        return view('benchmark');
    })->name('benchmark');
}

Route::middleware(ValidateSignature::class)
    ->get('/confirm/{subscriber:email}', ConfirmController::class)
    ->name('confirm-subscriber');
