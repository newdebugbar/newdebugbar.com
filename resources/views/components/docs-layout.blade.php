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
                class="md:!block mt-8 md:mt-0"
                x-cloak
                x-show="visible"
                x-trap="visible"
                @click.away="visible = false"
                @keydown.esc="visible = false"
            >
                <ul class="grid gap-8">
                    @foreach ($navigation as $item)
                        <li>
                            <a wire:navigate href="{{ $item['url'] }}" class="font-medium">
                                {{ $item['title'] }}
                            </a>

                            @if (! empty($item['sections']))
                                <ul class="grid mt-2">
                                    @foreach ($item['sections'] as $section)
                                        <li>
                                            <a href="{{ $item['url'] }}#{{ $section['slug'] }}" class="block px-4 py-3 transition-colors rounded text-gray-300/85 hover:bg-gray-800 hover:text-white">
                                                {{ $section['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</x-app>
