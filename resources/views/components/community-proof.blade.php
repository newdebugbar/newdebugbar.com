{{-- Cached project adoption and contributor links. Icons: Heroicons, MIT; see resources/icons/heroicons-license.txt. --}}
@props(['community'])

@php
    $downloads = $community['downloads'] ?? null;
    $stars = $community['stars'] ?? null;
    $contributors = $community['contributors'] ?? [];
    shuffle($contributors);
    $contributors = array_slice($contributors, 0, 6);
@endphp

@if ($downloads !== null || $stars !== null || $contributors !== [])
    <div
        class="mt-5 flex max-w-full flex-wrap items-center justify-center gap-x-5 gap-y-2 text-sm text-zinc-600 max-[22rem]:text-[0.8125rem] sm:mt-6 sm:gap-x-6 dark:text-zinc-400"
        data-community-proof
    >
        @if ($downloads !== null || $stars !== null)
            <div class="flex items-center gap-4 max-[22rem]:gap-3 sm:gap-6">
                @if ($downloads !== null)
                    <a
                        href="https://packagist.org/packages/newdebugbar/newdebugbar"
                        class="inline-flex min-h-10 items-center gap-2 rounded-sm whitespace-nowrap transition-colors hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 max-[22rem]:gap-1.5 dark:hover:text-violet-300"
                        aria-label="{{ Number::format($downloads) }} downloads on Packagist"
                        title="{{ Number::format($downloads) }} downloads on Packagist"
                    >
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span
                            ><strong
                                class="font-semibold text-zinc-950 dark:text-white"
                                >{{ strtolower(Number::abbreviate($downloads, maxPrecision: 1)) }}</strong>
                            downloads</span>
                    </a>
                @endif

                @if ($downloads !== null && $stars !== null)
                    <span class="h-5 w-px bg-zinc-200 dark:bg-white/10" aria-hidden="true"></span>
                @endif

                @if ($stars !== null)
                    <a
                        href="https://github.com/newdebugbar/newdebugbar"
                        class="inline-flex min-h-10 items-center gap-2 rounded-sm whitespace-nowrap transition-colors hover:text-violet-700 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-violet-500 max-[22rem]:gap-1.5 dark:hover:text-violet-300"
                        aria-label="{{ Number::format($stars) }} stars on GitHub"
                        title="{{ Number::format($stars) }} stars on GitHub"
                    >
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                        <span
                            ><strong
                                class="font-semibold text-zinc-950 dark:text-white"
                                >{{ strtolower(Number::abbreviate($stars, maxPrecision: 1)) }}</strong>
                            GitHub stars</span>
                    </a>
                @endif
            </div>
        @endif

        @if ($contributors !== [])
            <ul
                @class([
                    'flex items-center -space-x-2',
                    'sm:border-l sm:border-zinc-200 sm:pl-6 dark:sm:border-white/10' => $downloads !== null || $stars !== null,
                ])
                aria-label="Contributors"
                role="list"
            >
                @foreach ($contributors as $contributor)
                    <li class="relative focus-within:z-10 hover:z-10">
                        <a
                            href="https://github.com/{{ $contributor['login'] }}"
                            class="block size-9 rounded-full transition-shadow hover:ring-2 hover:ring-violet-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-500"
                            aria-label="{{ $contributor['login'] }} on GitHub"
                            title="{{ $contributor['login'] }}"
                        >
                            <img
                                src="https://avatars.githubusercontent.com/u/{{ $contributor['id'] }}?s=80&amp;v=4"
                                alt=""
                                width="36"
                                height="36"
                                decoding="async"
                                class="size-9 rounded-full border-2 border-white bg-zinc-100 object-cover dark:border-zinc-950 dark:bg-zinc-800"
                            />
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
