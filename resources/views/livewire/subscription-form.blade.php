<div>
    <form wire:submit="submit">
        <div class="flex gap-2 items-center">
            <div>
                <label for="email" class="sr-only">Email</label>

                <input
                    type="email"
                    wire:model="email"
                    id="email"
                    placeholder="you@example.com"
                    required
                    @if ($subscribed) disabled @endif
                    class="bg-gray-800 sm:min-w-[350px] border-0 rounded-lg px-4 py-3 placeholder-gray-600"
                />
            </div>

            <button
                @if ($subscribed) disabled @endif
                class="px-4 py-3 rounded-lg font-medium bg-blue-600 disabled:bg-gray-800"
            >
                @if ($subscribed) Thank you! @else Subscribe @endif
            </button>
        </div>

        @error('email')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </form>

    @session('status')
        <div
            class="fixed font-medium bottom-4 left-1/2 -translate-x-1/2 w-max bg-blue-800 text-white px-4 py-3 rounded-lg"
            x-cloak
            x-data="{ visible: false }"
            x-init="setTimeout(() => {
                visible = true

                setTimeout(() => {
                    visible = false
                }, 5000)
            }, 1)"
            x-show="visible"
            x-transition:enter="transition ease-out duration-[400ms]"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-[400ms]"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
        >
            <p>{{ $value }}</p>
        </div>
    @endsession
</div>
