<div
    {{ $attributes->class('pointer-events-auto flex items-center gap-3 mx-auto font-medium w-full md:w-[60dvw] lg:w-[30dvw] text-white px-4 py-3 rounded-lg') }}
    x-bind:class="{
        'bg-blue-800': 'info' === notification?.type,
        'bg-green-800': 'success' === notification?.type,
        'bg-red-800': 'error' === notification?.type
    }"
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
    <x-heroicon-o-information-circle class="size-5 -ml-1 flex-none" x-cloak x-show="notification?.type === 'info'" />
    <x-heroicon-o-check-circle class="size-5 -ml-1 flex-none" x-cloak x-show="notification?.type === 'success'" />
    <x-heroicon-o-x-circle class="size-5 -ml-1 flex-none" x-cloak x-show="notification?.type === 'error'" />

    <p>{!! (string) $slot ?? '<span x-text="notification?.message"></span>' !!}</p>
</div>
