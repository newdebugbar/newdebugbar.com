<?php

use App\Community\ProjectCommunity;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Illuminate\Support\defer;
use function Pest\Laravel\artisan;
use function Pest\Laravel\freezeTime;
use function Pest\Laravel\get;
use function Pest\Laravel\travel;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
    freezeTime();
    Http::preventStrayRequests();

    // Fields used from the public GitHub and Packagist responses checked on 2026-09-11.
    $this->people = [
        ['id' => 3613731, 'login' => 'benjamincrozat', 'type' => 'User'],
        ['id' => 8605605, 'login' => 'f4nu', 'type' => 'User'],
        ['id' => 10186898, 'login' => 'Aleksandar-Mitic', 'type' => 'User'],
    ];
    $this->responses = [
        'https://packagist.org/packages/newdebugbar/newdebugbar/stats.json' => Http::response(['downloads' => ['total' => 19903, 'monthly' => 19319, 'daily' => 1461]]),
        'https://api.github.com/repos/newdebugbar/newdebugbar' => Http::response(['full_name' => 'newdebugbar/newdebugbar', 'stargazers_count' => 200]),
        'https://api.github.com/repos/newdebugbar/newdebugbar/contributors?*' => Http::response($this->people),
        'https://api.github.com/repos/newdebugbar/newdebugbar.com/contributors?*' => Http::response([$this->people[0]]),
    ];
    $this->saved = [
        'downloads' => 12000,
        'stars' => 150,
        'contributors' => [['id' => 3613731, 'login' => 'benjamincrozat']],
    ];
});

it('refreshes public counts and merges people from both repositories without bots or duplicates', function () {
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar.com/contributors?*'] = Http::response([
        $this->people[0],
        ['id' => 2, 'login' => 'website-helper', 'type' => 'User'],
        ['id' => 3, 'login' => 'dependabot[bot]', 'type' => 'Bot'],
    ]);
    Http::fake($this->responses);

    artisan('app:refresh-community')->assertSuccessful();

    expect(Cache::get(ProjectCommunity::DATA_KEY))->toBe([
        'downloads' => 19903,
        'stars' => 200,
        'contributors' => [
            ['id' => 3613731, 'login' => 'benjamincrozat'],
            ['id' => 8605605, 'login' => 'f4nu'],
            ['id' => 10186898, 'login' => 'Aleksandar-Mitic'],
            ['id' => 2, 'login' => 'website-helper'],
        ],
    ]);
    Http::assertSentCount(4);
});

it('defers the first fetch until after rendering and reuses the saved data for a day', function () {
    Http::fake($this->responses);
    $community = app(ProjectCommunity::class);

    expect($community->forHero())->toBe([]);
    Http::assertNothingSent();

    defer()->invoke();
    Http::assertSentCount(4);
    expect($community->forHero()['downloads'])->toBe(19903);

    travel(23)->hours();
    $community->forHero();
    defer()->invoke();
    Http::assertSentCount(4);

    travel(2)->hours();
    expect($community->forHero()['downloads'])->toBe(19903);
    Http::assertSentCount(4);

    defer()->invoke();
    Http::assertSentCount(8);
});

it('keeps the previous value of a failed source while refreshing the others', function (mixed $count) {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $this->responses['https://packagist.org/packages/newdebugbar/newdebugbar/stats.json'] = Http::response(['downloads' => ['total' => $count]]);
    Http::fake($this->responses);

    artisan('app:refresh-community')->assertFailed();

    $saved = Cache::get(ProjectCommunity::DATA_KEY);
    expect($saved['downloads'])->toBe(12000)
        ->and($saved['stars'])->toBe(200)
        ->and($saved['contributors'])->toHaveCount(3);
})->with([
    'missing count' => null,
    'numeric string' => '19903',
    'negative count' => -1,
    'boolean count' => true,
    'fractional count' => 1.5,
]);

it('accepts a real zero count', function () {
    $this->responses['https://packagist.org/packages/newdebugbar/newdebugbar/stats.json'] = Http::response(['downloads' => ['total' => 0]]);
    Http::fake($this->responses);

    expect(app(ProjectCommunity::class)->refresh())->toBeTrue()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['downloads'])->toBe(0);
});

it('rejects stars from a different repository', function () {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar'] = Http::response(['full_name' => 'another/project', 'stargazers_count' => 999]);
    Http::fake($this->responses);

    expect(app(ProjectCommunity::class)->refresh())->toBeFalse()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['stars'])->toBe(150);
});

it('retains data and honors the provider retry delay after a rate limit', function () {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar'] = Http::response([], 429, ['Retry-After' => '3600']);
    Http::fake($this->responses);
    $community = app(ProjectCommunity::class);

    expect($community->refresh())->toBeFalse()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['stars'])->toBe(150);

    travel(30)->minutes();
    $community->forHero();
    defer()->invoke();
    Http::assertSentCount(4);

    travel(31)->minutes();
    $community->forHero();
    defer()->invoke();
    Http::assertSentCount(8);
});

it('does not replace retained data with malformed, oversized, or unsuccessful responses', function (string $body, int $status) {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $this->responses['https://packagist.org/packages/newdebugbar/newdebugbar/stats.json'] = Http::response($body, $status);
    Http::fake($this->responses);
    Log::spy();

    expect(app(ProjectCommunity::class)->refresh())->toBeFalse()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['downloads'])->toBe(12000);

    Log::shouldHaveReceived('warning')->once()->with('Unable to refresh public community data.', [
        'source' => 'downloads',
        'status' => $status === 200 ? null : $status,
    ]);
})->with([
    'malformed JSON' => ['provider-private-marker', 200],
    'oversized body' => [fn () => str_repeat(' ', 1_048_577), 200],
    'server failure' => ['provider-private-marker', 503],
    'redirect' => ['', 302],
]);

it('leaves unavailable values absent when a first refresh fails', function () {
    Http::fake(['*' => Http::response([], 503)]);

    expect(app(ProjectCommunity::class)->refresh())->toBeFalse()
        ->and(app(ProjectCommunity::class)->forHero())->toBe([]);
});

it('follows contributor pagination on the fixed GitHub endpoint', function () {
    unset($this->responses['https://api.github.com/repos/newdebugbar/newdebugbar/contributors?*']);
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar/contributors?per_page=100&page=1'] = Http::response([$this->people[0]], 200, [
        'Link' => '<https://api.github.com/repos/newdebugbar/newdebugbar/contributors?per_page=100&page=2>; rel="next"',
    ]);
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar/contributors?per_page=100&page=2'] = Http::response(array_slice($this->people, 1));
    Http::fake($this->responses);

    expect(app(ProjectCommunity::class)->refresh())->toBeTrue()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['contributors'])->toHaveCount(3);
    Http::assertSentCount(5);
});

it('retains the previous contributors if pagination repeats or exceeds its limit', function (bool $repeat) {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $page = 0;
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar/contributors?*'] = function () use (&$page, $repeat) {
        $page++;

        return Http::response([
            ['id' => $repeat ? 1 : $page, 'login' => 'contributor-'.$page, 'type' => 'User'],
        ], 200, ['Link' => '<https://api.github.com/repos/newdebugbar/newdebugbar/contributors?page='.($page + 1).'>; rel="next"']);
    };
    Http::fake($this->responses);

    expect(app(ProjectCommunity::class)->refresh())->toBeFalse()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['contributors'])->toBe($this->saved['contributors']);
    Http::assertSentCount($repeat ? 4 : 7);
})->with(['repeated page' => true, 'page limit' => false]);

it('rejects contributor identities that cannot safely form GitHub links', function (array $record) {
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    $this->responses['https://api.github.com/repos/newdebugbar/newdebugbar/contributors?*'] = Http::response([$record]);
    Http::fake($this->responses);

    expect(app(ProjectCommunity::class)->refresh())->toBeFalse()
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['contributors'])->toBe($this->saved['contributors']);
})->with([
    'unsafe login' => [['id' => 1, 'login' => '../redirect?to=example.com', 'type' => 'User']],
    'missing login' => [['id' => 1, 'type' => 'User']],
    'invalid ID' => [['id' => '1', 'login' => 'contributor', 'type' => 'User']],
]);

it('renders saved metrics and direct, named profile links in the hero', function () {
    $this->saved['contributors'] = array_map(fn (array $person) => array_intersect_key($person, array_flip(['id', 'login'])), $this->people);
    Cache::forever(ProjectCommunity::DATA_KEY, $this->saved);
    Cache::put(ProjectCommunity::CHECKED_KEY, true, now()->addDay());

    $response = get('/')->assertOk()->assertViewHas('community', $this->saved);
    $previousErrorHandling = libxml_use_internal_errors(true);
    $document = new DOMDocument;
    $document->loadHTML($response->getContent());
    libxml_clear_errors();
    libxml_use_internal_errors($previousErrorHandling);
    $xpath = new DOMXPath($document);

    $statsLinks = $xpath->query('//*[@data-community-proof]//a[not(ancestor::ul)]');
    expect($statsLinks)->toHaveCount(2)
        ->and($statsLinks->item(0)->getAttribute('href'))->toBe('https://packagist.org/packages/newdebugbar/newdebugbar')
        ->and($statsLinks->item(1)->getAttribute('href'))->toBe('https://github.com/newdebugbar/newdebugbar');

    $people = $xpath->query('//*[@data-community-proof]//ul[@aria-label="Contributors"]//a');
    expect($people)->toHaveCount(3);

    foreach ($people as $link) {
        $person = collect($this->people)->firstWhere('login', basename($link->getAttribute('href')));
        expect($person)->not->toBeNull();
        expect($link->getAttribute('href'))->toBe('https://github.com/'.$person['login'])
            ->and($link->getAttribute('aria-label'))->toBe($person['login'].' on GitHub')
            ->and($link->getElementsByTagName('img')->item(0)->getAttribute('src'))->toBe('https://avatars.githubusercontent.com/u/'.$person['id'].'?s=80&v=4');
    }

    Http::assertNothingSent();
});

it('shows a fresh random selection of at most six contributors without changing the cached list', function () {
    $contributors = array_map(fn (int $id) => ['id' => $id, 'login' => 'contributor-'.$id], range(1, 12));
    Cache::forever(ProjectCommunity::DATA_KEY, ['contributors' => $contributors]);
    Cache::put(ProjectCommunity::CHECKED_KEY, true, now()->addDay());
    $selections = [];

    try {
        foreach ([42, 73] as $seed) {
            mt_srand($seed);
            $response = get('/')->assertOk();
            $previousErrorHandling = libxml_use_internal_errors(true);
            $document = new DOMDocument;
            $document->loadHTML($response->getContent());
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorHandling);
            $xpath = new DOMXPath($document);
            $links = $xpath->query('//*[@data-community-proof]//ul[@aria-label="Contributors"]//a');
            $selection = [];

            foreach ($links as $link) {
                $selection[] = basename($link->getAttribute('href'));
            }

            expect($selection)->toHaveCount(6)
                ->and(array_unique($selection))->toHaveCount(6)
                ->and(array_diff($selection, array_column($contributors, 'login')))->toBe([]);
            $selections[] = $selection;
        }
    } finally {
        mt_srand();
    }

    expect($selections[0])->not->toBe($selections[1])
        ->and(Cache::get(ProjectCommunity::DATA_KEY)['contributors'])->toBe($contributors);
    Http::assertNothingSent();
});

it('renders the homepage without invented metrics when no saved data exists', function () {
    Http::fake(['*' => Http::response([], 503)]);

    get('/')->assertOk()->assertViewHas('community', []);
});
