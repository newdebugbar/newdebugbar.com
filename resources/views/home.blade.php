<x-app class="pb-8">
    <nav class="container xl:max-w-screen-lg flex items-center justify-end gap-8 mt-8">
        <a href="#roadmap" class="font-medium">Roadmap</a>

        <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the nav bar" class="fill-current">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="size-5"><path fill-rule="evenodd" d="M10 0c5.523 0 10 4.59 10 10.253 0 4.529-2.862 8.371-6.833 9.728-.507.101-.687-.219-.687-.492 0-.338.012-1.442.012-2.814 0-.956-.32-1.58-.679-1.898 2.227-.254 4.567-1.121 4.567-5.059 0-1.12-.388-2.034-1.03-2.752.104-.259.447-1.302-.098-2.714 0 0-.838-.275-2.747 1.051-.799-.227-1.655-.341-2.505-.345-.85.004-1.705.118-2.503.345-1.911-1.326-2.751-1.051-2.751-1.051-.543 1.412-.2 2.455-.097 2.714-.639.718-1.03 1.632-1.03 2.752 0 3.928 2.335 4.808 4.556 5.067-.286.256-.545.708-.635 1.371-.57.262-2.018.715-2.91-.852 0 0-.529-.985-1.533-1.057 0 0-.975-.013-.068.623 0 0 .655.315 1.11 1.5 0 0 .587 1.83 3.369 1.21.005.857.014 1.665.014 1.909 0 .271-.184.588-.683.493C2.865 18.627 0 14.783 0 10.253 0 4.59 4.478 0 10 0"/></svg>
        </a>

        <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the nav bar" class="-ml-4 fill-current">
            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 24 24" class="size-5"><path d="M14.095479 10.316482 22.286354 1h-1.940718l-7.115352 8.087682L7.551414 1H1l8.589488 12.231093L1 23h1.940717l7.509372-8.542861L16.448587 23H23l-8.904521-12.683518zm-2.658957 3.021983-.871624-1.218704-6.924311-9.68815h2.981339l5.58978 7.82155.867949 1.218704 7.26506 10.166271h-2.981339l-5.926854-8.299671z"/></svg>
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
                <li class="line-through">
                    Light and dark mode!
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through">
                    Sleep and streamlined user interface
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through">
                    A command palette that supports fuzzy search for fast developers
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through">
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

                <li class="line-through">
                    Queries
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li>
                    Request
                </li>

                <li class="line-through">
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

            <div class="mt-8 bg-gray-950 rounded-lg p-4 md:p-6 flex items-center md:justify-center gap-3">
                <x-heroicon-o-heart class="size-5 flex-none text-pink-500" />
                <p>Help me work full-time on the project by sponsoring it on <a href="https://github.com/sponsors/benjamincrozat" target="_blank" data-pirsch-event="Clicked GitHub Sponsors" class="font-medium text-white underline underline-offset-4 decoration-white/50">GitHub</a>.</p>
            </div>
        </div>
    </x-section>

    <footer class="mt-16 text-center">
        <p class="text-sm text-gray-500">
            Made with <span class="text-pink-400">♥</span> by <a href="https://x.com/benjamincrozat" target="_blank" data-pirsch-event="Clicked Benjamin's name" class="font-medium text-gray-400 underline underline-offset-4 decoration-gray-400/50">Benjamin Crozat</a>.
        </p>
    </footer>
</x-app>
