<x-app
    :$title
    :description="$description ?? ''"
>
    <div class="container grid gap-12 mt-8 md:gap-16 md:grid-cols-12 2xl:max-w-screen-xl md:mt-16">
        <div class="md:col-span-8">
            {{ $slot }}
        </div>

        <div class="md:col-span-4">
            <nav>
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
