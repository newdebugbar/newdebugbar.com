<a {{ $attributes->except('class')->merge(['href' => $link, 'target' => '_blank']) }}>
    <div {{ $attributes->class('bg-gray-800/50 flex items-start gap-4 md:gap-6 p-4 md:p-6 rounded-lg h-full') }}>
        <img src="{{ $avatar }}" alt="{{ $name }}" class="size-12 md:size-16 rounded-full" />

        <div>
            <p class="font-medium text-white">
                {{ $name }}
            </p>

            {{ $slot }}

            <p class="text-gray-400 mt-4">
                — {{ $bio }}
            </p>
        </div>
    </div>
</a>
