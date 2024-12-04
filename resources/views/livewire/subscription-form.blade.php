<div>
    <form
        @submit.prevent="$el.blur()"
        wire:submit="submit"
    >
        <div class="flex flex-wrap sm:flex-nowrap justify-center gap-2 items-center">
            <div class="flex-grow">
                <label for="email" class="sr-only">Email</label>

                <input
                    type="email"
                    wire:model="email"
                    id="email"
                    placeholder="you@example.com"
                    required
                    @if ($subscribed) disabled @endif
                    class="bg-gray-800 disabled:bg-transparent disabled:border disabled:border-gray-800 disabled:placeholder-gray-700 w-full sm:w-auto sm:min-w-[350px] border-0 rounded-lg px-4 py-3 placeholder-gray-600"
                />
            </div>

            <button
                @if ($subscribed) disabled @endif
                class="px-4 py-3 rounded-lg font-medium bg-blue-600 disabled:bg-gray-800"
            >
                @if ($subscribed) Thank you! @else Keep me posted @endif
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
