@php
    $example1 = <<<'EXAMPLE1'
$key = 'docs:journey-summary';
Cache::forget($key);

$first = Cache::remember($key, 300, fn () => ['days' => 8]);
$second = Cache::remember($key, 300, fn () => ['days' => 99]);
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
Redis::setex('docs:journey:heartbeat', 60, 'active');
Redis::get('docs:journey:heartbeat');
Redis::del('docs:journey:heartbeat');
EXAMPLE2;

@endphp

<x-layouts.docs
    meta-title="Debug Laravel cache and Redis | The New Debug Bar"
    description="Inspect Laravel cache hits, misses, writes, deletes, stores, tags, direct Redis commands, keys, timing, failures, and application call sites."
    :canonical="url('/docs/cache-and-redis')"
    og-title="Debug Laravel cache and Redis activity"
    og-description="Separate Laravel cache operations from direct Redis commands and trace unexpected misses, flushes, failures, or repeated work to code."
    page-title="Cache and Redis"
    :sections="[
        ['id' => 'difference', 'label' => 'Cache or Redis'],
        ['id' => 'cache', 'label' => 'Cache operations'],
        ['id' => 'misses', 'label' => 'Miss rates'],
        ['id' => 'redis', 'label' => 'Redis commands'],
        ['id' => 'keys', 'label' => 'Key policies'],
        ['id' => 'cache-example', 'label' => 'Example: a cold read followed by a hit'],
        ['id' => 'redis-example', 'label' => 'Inspect direct Redis work separately'],
        ['id' => 'cache-verification', 'label' => 'Verify the data returned by the cache'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Separate cache behavior from direct Redis work">
        Use Cache for Laravel’s cache abstraction and Redis for direct client commands, then trace keys, stores, results, failures, timing, and source without counting the same operation twice.
    </x-docs.page-header>

    <x-docs.screenshot name="cache" alt="Cache reads, writes, deletes, and the observed hit rate" caption="A cache miss becomes a useful lead when you know the key should already be warm and the app is reading the intended store." />

    <x-docs.section id="difference" title="Choose the inspector by API">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Cache records operations emitted by Laravel’s cache system, regardless of the selected cache driver. Redis records commands made through the Redis client. When a Redis-backed cache operation also emits a low-level command, The New Debug Bar removes the duplicate Redis entry.</p>

        <x-docs.callout class="mt-6" title="An empty Redis inspector can be correct:">
            using a Redis cache store does not mean every cache action should appear again as a direct Redis command.
        </x-docs.callout>
    </x-docs.section>

    <x-docs.section id="cache" title="Inspect cache operations and results">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Review reads, writes, deletes, flushes, stores, drivers, tags, key evidence, duration, failure state, and application source. Open unusual operations such as a full flush or repeated write before judging the total count.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>A hit shows that the selected store returned a cached value.</x-docs.check-item>
            <x-docs.check-item>A miss shows that the app had to continue without that cached value.</x-docs.check-item>
            <x-docs.check-item>A failed read or write is different from a normal miss and should be traced to its store and source.</x-docs.check-item>
            <x-docs.check-item>A flush clears the selected store broadly; confirm that the source intended that scope.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="misses" title="Treat a high miss rate as a lead">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">By default, a high-miss finding needs at least five cache reads and an 80% miss rate. The minimum avoids warning about one small lookup; the rate highlights repeated work that may not be benefiting from caching.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Confirm that the keys are expected to be warm, the correct store and tags are used, TTLs are appropriate, and no earlier source flushes or forgets them. A first request after a deliberate cache clear can have a valid high miss rate.</p>
    </x-docs.section>

    <x-docs.section id="redis" title="Inspect direct Redis commands">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Redis inspector keeps the command, connection, recognized bounded key evidence, timing, failure state, application call site, and an exception class when available. Arbitrary arguments, field values, and return values are not retained.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the source to distinguish an intentional pipeline, lock, rate limiter, pub/sub action, or application data structure from accidental repeated commands. A slow command needs database-side context as well as local duration.</p>
    </x-docs.section>

    <x-docs.section id="keys" title="Choose exact keys or stable hashes">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">key_policy</code> is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">full</code>, which keeps bounded exact cache keys, Redis keys, and cache tags for private local debugging.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Set <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_KEY_POLICY=hash</code> when stable matching is enough. Hashed evidence lets you recognize repeated use without retaining the original key.</p>
    </x-docs.section>

    <x-docs.section id="cache-example" title="Example: a cold read followed by a hit">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">This isolated example deliberately starts with one empty key. Run both reads in the same local action:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy cache example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The second result should still contain eight days: the cache hit avoids running the second producer. Open Cache and check the key, store, first miss, write, and later hit.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">If both reads miss in your real app, compare key construction, store, tags, TTL, and any earlier forget or flush. An array store is process-local, so it does not make a value survive separate HTTP requests.</p>
    </x-docs.section>

    <x-docs.section id="redis-example" title="Inspect direct Redis work separately">
        <x-docs.screenshot name="redis" alt="Direct Redis commands with recognized keys and application source" caption="Redis shows command and key evidence. Arbitrary command arguments, field values, and returned values are not retained." />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">In a configured local Redis connection, a short example can produce an obvious sequence:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy Redis example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check SETEX, GET, and DEL, their recognized key, connection, timing, and source. Do not expect the string <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">active</code> or the GET result to appear as a retained value.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">When Laravel cache uses Redis underneath, the duplicate low-level cache commands are removed from the Redis inspector. Use Cache to explain the cache result.</p>
    </x-docs.section>

    <x-docs.section id="cache-verification" title="Verify the data returned by the cache">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the value the application actually receives as well as the hit rate. A warm hit on the wrong key or store is not correct behavior. Use a focused application test for the key, producer result, and invalidation path.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.data-and-privacy')"
        title="Review retained local values"
        description="See how capture-time policies, collection limits, storage, browser access, and MCP access apply to keys and other profile data."
        link-label="Open data and privacy"
    />
</x-layouts.docs>
