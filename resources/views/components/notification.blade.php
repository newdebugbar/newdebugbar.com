<div
    {{ $attributes->class([
        'fixed flex items-center gap-3 font-medium bottom-4 left-1/2 -translate-x-1/2 w-max text-white px-4 py-3 rounded-lg',
        'bg-blue-800' => 'info' === $type,
        'bg-green-800' => 'success' === $type,
        'bg-red-800' => 'error' === $type,
    ]) }}
    x-cloak
    x-data="{ visible: false }"
    x-init="setTimeout(() => {
        visible = true

        setTimeout(() => { visible = false }, 5000)
    }, 1)"
    x-show="visible"
    x-transition:enter="transition ease-out duration-[400ms]"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-[400ms]"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    @click="visible = false"
>
    @if ('info' === $type)
        <x-heroicon-o-information-circle class="size-5 -ml-1" />
    @elseif ('success' === $type)
        <x-heroicon-o-check-circle class="size-5 -ml-1" />
    @elseif ('error' === $type)
        <x-heroicon-o-x-circle class="size-5 -ml-1" />
    @endif

    {{ $slot }}
</div>
