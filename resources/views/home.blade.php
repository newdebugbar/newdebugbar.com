<x-app>
    <div class="grid place-items-center text-center min-h-screen">
        <div>
            <h1 class="mt-8">
                <a wire:navigate href="{{ route('home') }}" data-pirsch-event="Clicked the logo">
                    <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="The New Debug Bar for Laravel" class="h-64 mx-auto" />
                </a>
            </h1>

            <h2 class="mt-5 pb-8 border-b border-gray-800 text-blue-200">
                A new modern, powerful, free, and open source<br />
                debug bar for Laravel developers.
            </h2>

            <p class="mt-8">
                It's coming in Q1 2025.<br />
                Get updates on <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub" class="font-medium text-white underline underline-offset-4 decoration-white/50">GitHub</a> and <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X" class="font-medium text-white underline underline-offset-4 decoration-white/50">X</a>, and subscribe.
            </p>

            <div class="container mt-4">
                <livewire:subscription-form />
            </div>

            <p class="mt-16 text-sm text-gray-500">Made with <span class="text-pink-400">♥</span> by <a href="https://x.com/benjamincrozat" target="_blank" data-pirsch-event="Clicked Benjamin's name" class="font-medium text-gray-400 underline underline-offset-4 decoration-gray-400/50">Benjamin Crozat</a></p>
        </div>
    </div>
</x-app>
