<div>
    <form
        @submit.prevent="() => {
            if (window.pirsch) {
                pirsch('Submitted the subscription form')
            }

            $el.blur()
        }"
        wire:submit="submit"
    >
        <div class="flex flex-wrap items-center justify-center gap-2 sm:flex-nowrap">
            <div class="flex-grow">
                <label for="email" class="sr-only">Email</label>

                <input
                    type="email"
                    wire:model="email"
                    id="email"
                    placeholder="you@example.com"
                    required
                    @if ($subscribed) disabled @endif
                    class="!bg-gray-800 !w-full !disabled:bg-transparent !disabled:border !disabled:border-gray-800 !disabled:placeholder-gray-700 !sm:min-w-[350px] !border-0 !rounded-lg !px-4 !py-3 !placeholder-gray-600"
                />
            </div>

            <button
                @if ($subscribed) disabled @endif
                data-pirsch-event="Clicked subscribe"
                class="flex-none w-full px-4 py-3 font-medium bg-blue-600 rounded-lg sm:w-auto disabled:bg-gray-800"
            >
                @if ($subscribed) Thank you! @else Keep me posted @endif
            </button>
        </div>

        @error('email')
            <p class="mt-2 text-red-500">{{ $message }}</p>
        @enderror
    </form>
</div>
