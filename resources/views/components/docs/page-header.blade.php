@props([
    'category',
    'title',
])

<header {{ $attributes }}>
    <p class="text-sm font-semibold text-violet-700 dark:text-violet-300">{{ $category }}</p>
    <h1 class="mt-3 text-balance text-[2.75rem] font-semibold leading-[1.02] tracking-[-0.052em] text-zinc-950 sm:text-[3.5rem] dark:text-white">
        {{ $title }}
    </h1>
    <p class="mt-6 max-w-[42rem] text-lg leading-8 text-zinc-600 sm:text-xl sm:leading-9 dark:text-zinc-400">
        {{ $slot }}
    </p>
</header>
