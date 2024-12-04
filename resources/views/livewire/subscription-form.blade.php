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

    @session('notification')
        <x-notification type="{{ $value['type'] }}">
            {{ $value['message'] }}
        </x-notification>
    @endsession
</div>
