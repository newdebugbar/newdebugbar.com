<div
    class="fixed flex items-center gap-3 font-medium bottom-4 left-1/2 -translate-x-1/2 w-max text-white px-4 py-3 rounded-lg"
    x-bind:class="{
        'bg-blue-800': 'info' === notification?.type,
        'bg-green-800': 'success' === notification?.type,
        'bg-red-800': 'error' === notification?.type
    }"
    x-cloak
    x-data="{
        notification: null,
        visible: false,
    }"
    x-show="visible"
    x-transition:enter="transition ease-out duration-[400ms]"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-[400ms]"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    @click="visible = false"
    @notification.window="() => {
        notification = $event.detail[0]

        visible = true

        setTimeout(() => {
            visible = false
        }, 5000)
    }"
>
    <x-heroicon-o-information-circle class="size-5 -ml-1" x-cloak x-show="notification?.type === 'info'" />
    <x-heroicon-o-check-circle class="size-5 -ml-1" x-cloak x-show="notification?.type === 'success'" />
    <x-heroicon-o-x-circle class="size-5 -ml-1" x-cloak x-show="notification?.type === 'error'" />

    <p x-text="notification?.message"></p>
</div>
