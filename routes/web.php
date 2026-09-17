<?php

use App\Community\ProjectCommunity;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (ProjectCommunity $community) => view('welcome', ['community' => $community->forHero()]));

if (app()->isLocal() || app()->runningUnitTests()) {
    Route::view('/__newdebugbar/social-preview', 'social.og-image')->name('social.og-image');
}

Route::get('/sitemap.xml', function () {
    $documentationUrls = collect(config('docs.navigation'))
        ->flatMap(fn (array $group): array => $group['pages'])
        ->map(fn (array $page): string => route($page['route']))
        ->all();

    return response()
        ->view('sitemap', [
            'urls' => [url('/'), route('docs.index'), ...$documentationUrls],
        ])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::prefix('docs')->name('docs.')->group(function () {
    Route::view('/', 'docs.index')->name('index');
    Route::view('/installation', 'docs.installation')->name('installation');
    Route::view('/requests', 'docs.requests')->name('requests');
    Route::view('/configuration', 'docs.configuration')->name('configuration');
    Route::view('/queries', 'docs.queries')->name('queries');
    Route::view('/performance', 'docs.performance')->name('performance');
    Route::view('/livewire', 'docs.livewire')->name('livewire');
    Route::view('/data-and-privacy', 'docs.data-and-privacy')->name('data-and-privacy');
    Route::view('/inspectors', 'docs.inspectors')->name('inspectors');
    Route::view('/eloquent', 'docs.eloquent')->name('eloquent');
    Route::view('/errors-and-logs', 'docs.errors-and-logs')->name('errors-and-logs');
    Route::view('/http-client', 'docs.http-client')->name('http-client');
    Route::view('/queues', 'docs.queues')->name('queues');
    Route::view('/mail-and-notifications', 'docs.mail-and-notifications')->name('mail-and-notifications');
    Route::view('/cache-and-redis', 'docs.cache-and-redis')->name('cache-and-redis');
    Route::view('/testing', 'docs.testing')->name('testing');
    Route::view('/mcp', 'docs.mcp')->name('mcp');
    Route::view('/troubleshooting', 'docs.troubleshooting')->name('troubleshooting');
    Route::view('/troubleshooting/bar-not-showing', 'docs.troubleshooting.bar-not-showing')->name('troubleshooting.bar-not-showing');
    Route::view('/troubleshooting/mcp', 'docs.troubleshooting.mcp')->name('troubleshooting.mcp');
    Route::view('/troubleshooting/missing-profiles', 'docs.troubleshooting.missing-profiles')->name('troubleshooting.missing-profiles');
    Route::view('/artisan', 'docs.artisan')->name('artisan');
    Route::view('/authorization', 'docs.authorization')->name('authorization');
    Route::view('/validation', 'docs.validation')->name('validation');
    Route::view('/views', 'docs.views')->name('views');
    Route::view('/events', 'docs.events')->name('events');
    Route::view('/debugging-with-agents', 'docs.debugging-with-agents')->name('debugging-with-agents');
    Route::view('/mcp-tools', 'docs.mcp-tools')->name('mcp-tools');
    Route::view('/local-environments', 'docs.local-environments')->name('local-environments');
});
