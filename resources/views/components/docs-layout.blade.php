<x-app
    :$title
    :description="$description ?? ''"
>
    <div class="container grid mt-8 gap-9 md:gap-16 md:grid-cols-12 2xl:max-w-screen-xl md:mt-16">
        <div class="md:col-span-8">
            {{ $slot }}
        </div>

        <div
            class="md:col-span-4 -order-1 md:order-none"
            x-data="{ visible: false }"
        >
            <button
                class="w-full px-4 py-2 text-sm transition-colors duration-300 border border-gray-700 rounded md:hidden"
                x-bind:class="{ 'bg-gray-950 border-transparent': visible }"
                @click="visible = !visible"
            >
                <span x-text="visible ? 'Hide' : 'Navigation'">
                    Navigation
                </span>

                <x-heroicon-o-chevron-down
                    class="inline ml-1 -mr-4 transition-transform duration-300 -translate-y-px size-3"
                    x-bind:class="{ '-rotate-180': visible }"
                />
            </button>

            <nav
                class="md:!block mt-8 md:mt-0 text-gray-300/85"
                x-cloak
                x-show="visible"
                x-trap="visible"
                @click.away="visible = false"
                @keydown.esc="visible = false"
            >
                <ul class="grid gap-8">
                    @foreach ($navigation as $group => $items)
                        <li class="grid gap-4">
                            @if ($items->count() > 1)
                                <span class="font-medium text-white cursor-default">
                                    {{ $group }}
                                </span>
                            @endif

                            <ul @class([
                                'grid gap-4',
                                'ml-4' => $items->count() > 1,
                            ])>
                                @foreach ($items as $item)
                                    <li class="flex items-center gap-3">
                                        @if (request()->fullUrlIs($item['url']))
                                            <div @class([
                                                'w-1 h-4 bg-blue-500 rounded-full',
                                                'md:-ml-4' => $items->count() > 1,
                                            ])></div>
                                        @endif

                                        <a wire:navigate href="{{ $item['url'] }}" class="transition-colors hover:text-white">
                                            {{ $item['heading'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</x-app>
