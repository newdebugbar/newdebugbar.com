<?php

namespace App\Community;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;
use UnexpectedValueException;

use function Illuminate\Support\defer;

/**
 * Keeps the homepage's public downloads, stars, and contributors in the cache.
 * Refreshes run after a response or from Artisan, retaining each source's last
 * successful values when a provider fails.
 */
class ProjectCommunity
{
    public const DATA_KEY = 'newdebugbar.community.data';

    public const CHECKED_KEY = 'newdebugbar.community.checked';

    private const MAX_RESPONSE_BYTES = 1_048_576;

    private const MAX_CONTRIBUTOR_PAGES = 5;

    private float $deadline;

    private int $retryAfter = 600;

    /**
     * @return array{downloads?: int, stars?: int, contributors?: list<array{id: int, login: string}>}
     */
    public function forHero(): array
    {
        if (! Cache::has(self::CHECKED_KEY)) {
            defer(fn () => $this->refresh(), 'newdebugbar.community.refresh');
        }

        return Cache::get(self::DATA_KEY, []);
    }

    public function refresh(bool $force = false): bool
    {
        return (bool) Cache::lock('newdebugbar.community.refresh', 60)->get(function () use ($force): bool {
            if (! $force && Cache::has(self::CHECKED_KEY)) {
                return true;
            }

            $this->deadline = microtime(true) + 30;
            $this->retryAfter = 600;
            Cache::put(self::CHECKED_KEY, true, $this->retryAfter);

            $data = Cache::get(self::DATA_KEY, []);
            $successful = true;

            foreach ([
                'downloads' => fn () => $this->count($this->request('https://packagist.org/packages/newdebugbar/newdebugbar/stats.json')->json('downloads.total')),
                'stars' => fn () => $this->stars(),
                'contributors' => fn () => $this->contributors(),
            ] as $source => $fetch) {
                try {
                    $data[$source] = $fetch();
                    Cache::forever(self::DATA_KEY, $data);
                } catch (Throwable $exception) {
                    $successful = false;

                    Log::warning('Unable to refresh public community data.', [
                        'source' => $source,
                        'status' => $exception->getCode() >= 100 && $exception->getCode() <= 599
                            ? $exception->getCode()
                            : null,
                    ]);
                }
            }

            Cache::put(self::CHECKED_KEY, true, $successful ? now()->addDay() : $this->retryAfter);

            return $successful;
        });
    }

    private function stars(): int
    {
        $response = $this->request('https://api.github.com/repos/newdebugbar/newdebugbar');

        if ($response->json('full_name') !== 'newdebugbar/newdebugbar') {
            throw new UnexpectedValueException('Unexpected GitHub repository.');
        }

        return $this->count($response->json('stargazers_count'));
    }

    /**
     * @return list<array{id: int, login: string}>
     */
    private function contributors(): array
    {
        $contributors = [];

        foreach (['newdebugbar', 'newdebugbar.com'] as $repository) {
            $seen = [];

            for ($page = 1; $page <= self::MAX_CONTRIBUTOR_PAGES; $page++) {
                $response = $this->request("https://api.github.com/repos/newdebugbar/{$repository}/contributors", [
                    'per_page' => 100,
                    'page' => $page,
                ]);
                $records = $response->json();

                if (! is_array($records) || ! array_is_list($records) || count($records) > 100) {
                    throw new UnexpectedValueException('Invalid GitHub contributor list.');
                }

                foreach ($records as $record) {
                    if (is_array($record) && ($record['type'] ?? null) === 'Bot') {
                        continue;
                    }

                    if (! is_array($record)
                        || ($record['type'] ?? null) !== 'User'
                        || ! is_int($record['id'] ?? null)
                        || $record['id'] < 1
                        || ! is_string($record['login'] ?? null)
                        || ! preg_match('/\A[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,37}[a-zA-Z0-9])?\z/', $record['login'])
                        || isset($seen[$record['id']])) {
                        throw new UnexpectedValueException('Invalid or repeated GitHub contributor.');
                    }

                    $seen[$record['id']] = true;
                    $contributors[$record['id']] ??= [
                        'id' => $record['id'],
                        'login' => $record['login'],
                    ];
                }

                if (! str_contains($response->header('Link'), 'rel="next"')) {
                    break;
                }

                if ($page === self::MAX_CONTRIBUTOR_PAGES) {
                    throw new UnexpectedValueException('GitHub contributor page limit reached.');
                }
            }
        }

        return array_values($contributors);
    }

    private function count(mixed $value): int
    {
        if (! is_int($value) || $value < 0) {
            throw new UnexpectedValueException('Invalid community count.');
        }

        return $value;
    }

    /**
     * @param  array<string, int>  $query
     */
    private function request(string $url, array $query = []): Response
    {
        $remaining = $this->deadline - microtime(true);

        if ($remaining <= 0) {
            throw new RuntimeException('Community refresh time limit reached.');
        }

        $request = Http::acceptJson()
            ->withUserAgent('NewDebugBarWebsite (https://newdebugbar.com)')
            ->withoutRedirecting()
            ->connectTimeout(min(2, $remaining))
            ->timeout(min(5, $remaining))
            ->withOptions([
                'progress' => static function ($total, $downloaded): void {
                    if ($total > self::MAX_RESPONSE_BYTES || $downloaded > self::MAX_RESPONSE_BYTES) {
                        throw new RuntimeException('Community response size limit reached.');
                    }
                },
            ]);

        if (str_starts_with($url, 'https://api.github.com/')) {
            $request->accept('application/vnd.github+json')->withHeader('X-GitHub-Api-Version', '2026-03-10');
        }

        $response = $request->get($url, $query);

        if (in_array($response->status(), [403, 429], true)) {
            $retryAfter = $response->header('Retry-After');
            $reset = $response->header('X-RateLimit-Reset');
            $this->retryAfter = min(86_400, max(
                $this->retryAfter,
                ctype_digit($retryAfter) ? (int) $retryAfter : 0,
                ctype_digit($reset) ? (int) $reset - now()->timestamp : 0,
            ));
        }

        if (! $response->ok()) {
            throw new RuntimeException('Community provider request failed.', $response->status());
        }

        if (strlen($response->body()) > self::MAX_RESPONSE_BYTES) {
            throw new RuntimeException('Community response size limit reached.');
        }

        return $response;
    }
}
