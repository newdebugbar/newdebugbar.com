<x-app class="pb-8">
    <div class="container mt-8 md:max-w-screen-sm">
        <div class="text-center">
            <h1>
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

            <div class="mt-4 max-w-[480px] mx-auto">
                <livewire:subscription-form />
            </div>
        </div>
    </div>

    <section class="mt-32 container 2xl:max-w-screen-xl">
        <h2 class="text-center uppercase text-sm tracking-widest">Wall of love</h2>

        <div class="grid mt-8 md:grid-cols-2 gap-4">
            <a href="https://x.com/michaeldyrynda/status/1834328870969016687" target="_blank" data-pirsch-event="Clicked Michael's tweet">
                <div class="bg-gray-800/50 flex items-start gap-4 md:gap-6 p-4 md:p-6 rounded-lg h-full">
                    <img src="https://pbs.twimg.com/profile_images/1858019523577917444/SQU_Kbod_400x400.jpg" alt="Michael Dyrynda" class="size-12 md:size-16 rounded-full" />

                    <div>
                        <p class="font-medium text-white">Michael Dyrynda</p>
                        <p>OK, this is kinda awesome [...] Very interested in this the more I see!</p>
                        <p class="text-gray-400 mt-4">— Organizer of Laracon AU and podcast co-host.</p>
                    </div>
                </div>
            </a>

            <a href="https://x.com/barryvdh/status/1836458733716803766" target="_blank" data-pirsch-event="Clicked Barry's tweet">
                <div class="bg-gray-800/50 flex items-start gap-4 md:gap-6 p-4 md:p-6 rounded-lg h-full">
                    <img src="https://pbs.twimg.com/profile_images/951138971026952194/VEfZA8NC_400x400.jpg" alt="Barry vd. Heuvel" class="size-12 md:size-16 rounded-full" />

                    <div>
                        <p class="font-medium text-white">Barry vd. Heuvel</p>
                        <p>Wow, looks nice! [...] looking forward to borrow some good ideas from you for Laravel Debugbar and Telescope Toolbar. 😁 Good luck!</p>
                        <p class="text-gray-400 mt-4">— Maker of the original debug bar for Laravel.</p>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <footer class="mt-16 text-center">
        <p class="text-sm text-gray-500">
            Made with <span class="text-pink-400">♥</span> by <a href="https://x.com/benjamincrozat" target="_blank" data-pirsch-event="Clicked Benjamin's name" class="font-medium text-gray-400 underline underline-offset-4 decoration-gray-400/50">Benjamin Crozat</a>.
        </p>
    </footer>
</x-app>
