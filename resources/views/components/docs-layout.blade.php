<x-app
    :$title
    :description="$description ?? ''"
>
    <div class="container grid mt-8 gap-9 md:gap-16 md:grid-cols-12 2xl:max-w-screen-xl md:mt-16">
        <div class="md:col-span-8">
            {{ $slot }}
        </div>

        <div class="md:col-span-4 -order-1 md:order-none">
            <nav class="text-gray-300/85">
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
                                            <div class="w-1 h-4 bg-blue-500 rounded-full"></div>
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
