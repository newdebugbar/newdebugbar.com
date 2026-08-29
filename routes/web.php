<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/docs/installation', 'docs.installation')->name('docs.installation');
