<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('/docs/installation', 'docs.installation')->name('docs.installation');
Route::view('/docs/mcp', 'docs.mcp')->name('docs.mcp');
