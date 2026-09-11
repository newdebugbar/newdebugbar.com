@php
    $example1 = <<<'EXAMPLE1'
return view('trips.summary', ['title' => $trip->title]);
EXAMPLE1;

    $example2 = <<<'EXAMPLE2'
<h1>{{ $journeyTitle }}</h1>
EXAMPLE2;

    $example3 = <<<'EXAMPLE3'
return view('trips.summary', ['journeyTitle' => $trip->title]);
EXAMPLE3;

    $example4 = <<<'EXAMPLE4'
get('/trips/kyoto-autumn')
    ->assertOk()
    ->assertViewHas('journeyTitle', 'Kyoto in autumn');
EXAMPLE4;

@endphp

<x-layouts.docs
    meta-title="Find missing data and repeated Blade work | The New Debug Bar"
    description="Inspect Blade view occurrences, original template sources, registered composers, and retained view data with The New Debug Bar."
    :canonical="url('/docs/views')"
    og-title="Find missing data and repeated Blade work"
    og-description="Inspect Blade view occurrences, original template sources, registered composers, and retained view data with The New Debug Bar."
    page-title="Blade views"
    :sections="[
        ['id' => 'choose', 'label' => 'Find the right template occurrence'],
        ['id' => 'data', 'label' => 'Compare the expected key with the retained data'],
        ['id' => 'composers', 'label' => 'Check composers and shared data'],
        ['id' => 'repetition', 'label' => 'Investigate repeated composition'],
        ['id' => 'agents', 'label' => 'Read deeper view data with an agent'],
        ['id' => 'verify', 'label' => 'Verify the actual page output'],
    ]"
>
    <x-docs.page-header category="Framework activity" title="Find missing data and repeated Blade work">
        Choose the actual template occurrence that built the unexpected output. Its retained data and original source give you a concrete place to start.
    </x-docs.page-header>

    <x-docs.screenshot name="views" alt="Application view occurrences in the Views inspector" caption="Start with application templates, then reveal framework views only when they help explain the rendering path." />

    <x-docs.section id="choose" title="Find the right template occurrence">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open Views in the selected request. Search for a template name or source path. The application filter keeps the first view focused; switch to all or framework views when needed.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A template can be composed several times with different data. Choose the occurrence that corresponds to the visible card, row, mail, or component you are investigating.</p>
    </x-docs.section>

    <x-docs.section id="data" title="Compare the expected key with the retained data">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Suppose the controller passes a title under one name:</p>

        <x-docs.copyable-code class="mt-5" :code="$example1" copy-label="Copy view-data example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">But the template reads a different variable:</p>

        <x-docs.copyable-code class="mt-5" :code="$example2" copy-label="Copy Blade example" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Open the retained data for <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">trips.summary</code>. Seeing <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">title</code> where the template expects <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">journeyTitle</code> points to a data-contract mismatch. Align the key and the template:</p>

        <x-docs.copyable-code class="mt-5" :code="$example3" copy-label="Copy corrected view data" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Then reload the same page and check its rendered heading. If the variable is still wrong, inspect the view composer and the occurrence that actually produced this part of the page.</p>
    </x-docs.section>

    <x-docs.section id="composers" title="Check composers and shared data">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Registered composer evidence can explain data added outside the controller. Follow the composer source, shared view data, and the selected template rather than assuming the controller supplied every value.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">The package retains bounded data. It does not execute renderable objects or lazy component methods to turn them into a screenshot-friendly value. A class label for such a value is expected.</p>
    </x-docs.section>

    <x-docs.section id="repetition" title="Investigate repeated composition">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A partial used once per itinerary day should appear several times. Repetition becomes useful evidence when the same partial or data lookup runs more often than the output needs.</p>

        <ul class="mt-5 space-y-3" role="list">
            <x-docs.check-item>Check the parent loop and the number of visible records.</x-docs.check-item>
            <x-docs.check-item>Look for data lookups in a template, accessor, or composer.</x-docs.check-item>
            <x-docs.check-item>Use <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.queries') }}">Queries</a> to see whether repeated view work also repeats SQL.</x-docs.check-item>
            <x-docs.check-item>Compare the same request after changing the caller.</x-docs.check-item>
        </ul>

        <x-docs.callout class="mt-6" title="Views do not measure per-template render duration">The inspector records composition activity, order, sources, and retained data. Use the <a class="font-medium text-violet-700 underline decoration-violet-300 underline-offset-4 hover:decoration-violet-600 dark:text-violet-300 dark:decoration-violet-500/60" href="{{ route('docs.performance') }}">Timeline and performance guide</a> for measured operations.</x-docs.callout>
    </x-docs.section>

    <x-docs.section id="agents" title="Read deeper view data with an agent">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Start at <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/views</code> with <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">get-debug-profile-data</code>, then follow the returned paths to the chosen occurrence. Retained data is available under paths such as <code class="font-mono text-[0.9em] text-zinc-950 dark:text-zinc-100">/inspectors/views/payload/items/0/data</code>; use the returned index for your profile.</p>

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">A missing field may have been omitted at capture time. Read the omission state before treating a partial object as complete.</p>
    </x-docs.section>

    <x-docs.section id="verify" title="Verify the actual page output">
        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Check the corrected HTML and the chosen view’s retained data. For an important data contract, a Laravel view assertion can protect the supplied value:</p>

        <x-docs.copyable-code class="mt-5" :code="$example4" copy-label="Copy view assertion" copy-success="Example copied" :multiline="true" />

        <p class="mt-4 text-base leading-7 text-zinc-600 dark:text-zinc-400">Use this assertion only on a route that actually returns that key. Keep response or browser assertions for the rendered result as well.</p>
    </x-docs.section>
</x-layouts.docs>
