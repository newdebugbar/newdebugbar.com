<a {{ $attributes->except('class')->merge(['href' => $link, 'target' => '_blank']) }}>
    <div {{ $attributes->class('bg-gradient-to-r from-gray-800/10 to-gray-800/30 flex items-start gap-4 md:gap-6 p-4 md:p-6 rounded-lg h-full') }}>
        <img src="{{ $avatar }}" alt="{{ $name }}" class="rounded-full size-12 md:size-16" />

        <div>
            <p class="font-medium text-white">
                {{ $name }}
            </p>

            {{ $slot }}

            <p class="mt-4 text-gray-400">
                — {{ $bio }}
            </p>
        </div>
    </div>
</a>
