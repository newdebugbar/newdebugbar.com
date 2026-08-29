<x-layouts.docs
    meta-title="Debug Laravel cache and Redis | New Debug Bar"
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
    ]"
>
    <x-docs.page-header category="Framework activity" title="Separate cache behavior from direct Redis work">
        Use Cache for Laravel’s cache abstraction and Redis for direct client commands, then trace keys, stores, results, failures, timing, and source without counting the same operation twice.
    </x-docs.page-header>

    <x-docs.section id="difference" title="Choose the section by API">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Cache records operations emitted by Laravel’s cache system, regardless of the selected cache driver. Redis records commands made through the Redis client. When a Redis-backed cache operation also emits a low-level command, New Debug Bar removes the duplicate Redis entry.</p>

        <x-docs.callout class="mt-6" title="An empty Redis section can be correct:">
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
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Redis section keeps command, connection, bounded key evidence and parameters, timing, failure state, and the application call site. Results and error details are bounded and redacted before storage.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use the source to distinguish an intentional pipeline, lock, rate limiter, pub/sub action, or application data structure from accidental repeated commands. A slow command needs database-side context as well as local duration.</p>
    </x-docs.section>

    <x-docs.section id="keys" title="Choose exact keys or stable hashes">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The default <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">key_policy</code> is <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">full</code>, which keeps bounded exact cache keys, Redis keys, and cache tags for private local debugging.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Set <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">NEWDEBUGBAR_KEY_POLICY=hash</code> when stable matching is enough. Hashed evidence lets you recognize repeated use without retaining the original key.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.data-and-privacy')"
        title="Review retained local values"
        description="See how capture-time policies, collection limits, storage, browser access, and MCP access apply to keys and other profile data."
        link-label="Open data and privacy"
    />
</x-layouts.docs>
