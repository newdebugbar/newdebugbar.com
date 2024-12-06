<x-app>
    <nav class="container xl:max-w-screen-lg flex items-center justify-end gap-8 mt-8">
        <a href="#roadmap" class="font-medium">Roadmap</a>

        <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the nav bar" class="fill-current">
            <x-icon-github class="size-5" />
        </a>

        <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the nav bar" class="-ml-4 fill-current">
            <x-icon-x class="size-5" />
        </a>
    </nav>

    <div class="container mt-8 md:max-w-screen-sm">
        <div class="text-center">
            <h1>
                <a wire:navigate href="{{ route('home') }}" data-pirsch-event="Clicked the logo">
                    <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="{{ config('app.name') }}" class="h-64 mx-auto" />
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

    <x-section class="mt-32">
        <x-slot:title>
            Wall of love
        </x-slot>

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
    </x-section>

    <x-section id="roadmap" class="mt-32">
        <x-slot:title>
            Roadmap
        </x-slot>

        <div class="md:max-w-screen-sm md:mx-auto grid gap-4 mt-8">
            <h3 class="text-xl font-medium">Version 1.0 (Q1 2025)</h3>

            <h4 class="font-medium">A modern UI</h4>

            <ul class="pl-4 ml-4 list-disc grid gap-2">
                <li class="line-through opacity-55">
                    Light and dark mode!
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Sleep and streamlined user interface
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    A command palette that supports fuzzy search for fast developers
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    A floating panel with glanceable information that you can position anywhere
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>
            </ul>

            <h4 class="font-medium">Customization</h4>

            <ul class="pl-4 ml-4 list-disc grid gap-2">
                <li>
                    Publish the debug bar's views and change them however you like
                </li>

                <li>
                    Create your own workspaces
                </li>
            </ul>

            <h4 class="font-medium">Workspaces</h4>

            <ul class="pl-4 ml-4 list-disc grid gap-2">
                <li>
                    Cache
                </li>

                <li>
                    Dumps
                </li>

                <li>
                    Jobs
                </li>

                <li>
                    Log
                </li>

                <li>
                    Mail
                </li>

                <li>
                    Models
                </li>

                <li>
                    Notifications
                </li>

                <li class="line-through opacity-55">
                    Queries
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li>
                    Request
                </li>

                <li class="line-through opacity-55">
                    Route
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li>
                    Views
                </li>
            </ul>

            <h3 class="text-xl font-medium">Beyond version 1.0</h3>

            <ul class="pl-4 ml-4 list-disc grid gap-2">
                <li>
                    Pin your favorite workspaces
                </li>

                <li>
                    Customize the UI to your liking
                </li>

                <li>
                    AI-assisted debugging (use your OpenAI API key)
                </li>

                <li>
                    User accounts to sync settings, favorites, and more, accross projects effortlessly
                </li>
            </ul>

            <div class="mt-4 bg-gray-950/30 rounded-lg p-4 md:p-6 flex items-center md:justify-center gap-3">
                <x-heroicon-o-heart class="size-5 flex-none text-pink-500" />
                <p>Help me work full-time on the project by sponsoring it on <a href="https://github.com/sponsors/benjamincrozat" target="_blank" data-pirsch-event="Clicked GitHub Sponsors" class="font-medium text-white underline underline-offset-4 decoration-white/50">GitHub</a>.</p>
            </div>
        </div>
    </x-section>
</x-app>
