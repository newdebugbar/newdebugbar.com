<x-layouts.docs
    meta-title="Profile Laravel performance with New Debug Bar"
    description="Use New Debug Bar request duration, query time, peak memory, timeline, HTTP calls, views, and events to find expensive Laravel work."
    :canonical="url('/docs/performance')"
    og-title="Profile Laravel request performance"
    og-description="A practical workflow for locating expensive work and comparing a Laravel request before and after a change."
    page-title="Performance"
    :sections="[
        ['id' => 'measure', 'label' => 'Measure a stable request'],
        ['id' => 'overview', 'label' => 'Read the overview'],
        ['id' => 'timeline', 'label' => 'Use the timeline'],
        ['id' => 'bottlenecks', 'label' => 'Follow bottlenecks'],
        ['id' => 'verify', 'label' => 'Verify improvements'],
    ]"
>
    <x-docs.page-header category="Debugging workflows" title="Find where the request spent its time">
        Use the overview to choose a direction, then follow ordered work, queries, HTTP calls, rendering, models, and events to the code you can change.
    </x-docs.page-header>

    <x-docs.section id="measure" title="Measure a stable request">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Local timings move with cold caches, debugger overhead, machine load, and the amount of data on the page. Make comparisons useful before drawing a conclusion.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Compare the same method, path, request type, and realistic data.</x-docs.check-item>
            <x-docs.check-item>Use a second warm request when startup, compilation, or cache warming affects the first one.</x-docs.check-item>
            <x-docs.check-item>Repeat the request more than once when the difference is small.</x-docs.check-item>
            <x-docs.check-item>Use production monitoring for production latency; use New Debug Bar to explain local work.</x-docs.check-item>
        </ul>
    </x-docs.section>

    <x-docs.section id="overview" title="Use the overview to choose a direction">
        <x-docs.figure class="mt-6" caption="Request duration, query count, query time, status, and findings narrow the search before you open a detailed inspector.">
            <x-screenshots.request-inspector
                alt="New Debug Bar request overview with duration and query measurements"
                loading="lazy"
            />
        </x-docs.figure>

        <div class="mt-7 overflow-x-auto rounded-xl border border-zinc-200 dark:border-white/10">
            <table class="w-full min-w-[42rem] text-left text-sm">
                <thead class="bg-zinc-50 text-zinc-950 dark:bg-white/[0.035] dark:text-white">
                    <tr>
                        <th class="px-4 py-3 font-semibold" scope="col">Signal</th>
                        <th class="px-4 py-3 font-semibold" scope="col">Useful next section</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 text-zinc-600 dark:divide-white/10 dark:text-zinc-400">
                    <tr><td class="px-4 py-3">Query time explains much of the request</td><td class="px-4 py-3">Queries and Models</td></tr>
                    <tr><td class="px-4 py-3">Total duration is high but query time is low</td><td class="px-4 py-3">Timeline, HTTP client, Views, and Events</td></tr>
                    <tr><td class="px-4 py-3">Peak memory is unexpectedly high</td><td class="px-4 py-3">Models, Views, returned data, and large captured operations</td></tr>
                    <tr><td class="px-4 py-3">One Livewire update is slow</td><td class="px-4 py-3">Livewire, Timeline, Queries, and Views for that update profile</td></tr>
                </tbody>
            </table>
        </div>
    </x-docs.section>

    <x-docs.section id="timeline" title="Read work in execution order">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The Timeline joins supported activity into one ordered view. Use it to see whether expensive work is isolated, repeated, or waiting on another operation.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open a timeline item for its source and related detail. A long outbound request, a sequence of repeated queries, repeated view rendering, or a burst of model work gives you a concrete section to inspect next.</p>
    </x-docs.section>

    <x-docs.section id="bottlenecks" title="Follow the bottleneck to its cause">
        <ol class="mt-6 space-y-6" role="list">
            <x-docs.step number="1" title="Open the dominant operation">
                Choose the largest credible source of time or memory, not merely the section with the most rows.
            </x-docs.step>
            <x-docs.step number="2" title="Inspect its application source">
                Use the file, line, and retained application stack to find the caller that controls the work.
            </x-docs.step>
            <x-docs.step number="3" title="Check related evidence">
                Connect a model retrieval to its queries, an HTTP call to its response, or a repeated view to the data and loop that rendered it.
            </x-docs.step>
            <x-docs.step number="4" title="Change one cause">
                Reduce duplicate work, request less data, batch a remote call, cache a stable result, or move work only when the evidence supports it.
            </x-docs.step>
        </ol>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify the improvement">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Repeat the same warm request and compare the metric your change was meant to improve. Also check status, response behavior, query count, and findings so a faster result did not hide missing work.</p>

        <p class="mt-5 text-base leading-7 text-zinc-600 dark:text-zinc-400">For a path with a stable budget, use New Debug Bar’s profile assertions to protect maximum duration, query count, query time, peak memory, and error-free behavior in a Laravel test.</p>
    </x-docs.section>

    <x-docs.next-step
        :href="route('docs.testing')"
        title="Protect a performance budget"
        description="Read a profile from the response header and assert the limits that matter for an important Laravel path."
        link-label="Open the testing guide"
    />
</x-layouts.docs>
