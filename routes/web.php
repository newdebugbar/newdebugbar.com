<?php

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Notifications\Subscribers\Confirm;
use Illuminate\Routing\Middleware\ValidateSignature;
use App\Http\Controllers\Subscribers\ConfirmController;
use App\Http\Controllers\Documentation\ShowDocumentController;
use App\Http\Controllers\Documentation\RedirectToFirstFileController;

Route::get('/', HomeController::class)->name('home');

Route::middleware(ValidateSignature::class)
    ->get('/confirm/{subscriber:email}', ConfirmController::class)
    ->name('confirm-subscriber');

Route::get('/docs/{version?}', RedirectToFirstFileController::class)
    ->name('docs.index');

Route::get('/docs/{version}/{slug}', ShowDocumentController::class)
    ->name('docs.show');

if (app()->isLocal()) {
    Route::get('/benchmark', function () {
        cache()->put('foo', 'bar');
        cache()->put('baz', 'qux', 3600);

        Subscriber::query()->first()->notify(new Confirm);

        User::query()->get();

        return view('benchmark');
    })->name('benchmark');
}
