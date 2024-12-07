<x-app>
    <div class="container mt-8 md:max-w-screen-sm">
        <div class="text-center">
            <h1>
                <a wire:navigate href="{{ route('home') }}" data-pirsch-event="Clicked the logo">
                    <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="{{ config('app.name') }}" class="h-56 md:h-64 mx-auto" />
                </a>
            </h1>

            <h2 class="mt-5 text-blue-200">
                A new modern, powerful, free, and open source<br />
                debug bar for Laravel developers.
            </h2>

            <div class="h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent my-8"></div>

            <p>
                It's coming in Q1 2025.<br />
                Get updates on <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub" class="font-medium text-white underline underline-offset-4 decoration-white/50">GitHub</a> and <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X" class="font-medium text-white underline underline-offset-4 decoration-white/50">X</a>, and <strong class="font-medium text-white">join {{ trans_choice(':count subscriber|:count subscribers', $subscribersCount) }}</strong>.
            </p>

            <div class="mt-4 max-w-[480px] mx-auto">
                <livewire:subscription-form />
            </div>
        </div>
    </div>

    <x-section class="mt-24 xl:!max-w-screen-lg">
        <x-slot:title>
            Sponsors
        </x-slot>

        <div class="grid grid-cols-2 gap-4 mt-8">
            <a href="https://sevalla.com?ref=newdebugbar.com">
                <div class="flex gap-5 bg-gray-950/30 h-full p-6 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 186" class="h-8 flex-none fill-[#F97315] mt-1"><path fill="#F97315" fill-rule="evenodd" d="M33 0C14.775 0 0 14.775 0 33v120c0 18.225 14.775 33 33 33h126c18.226 0 33-14.775 33-33V33c0-18.225-14.774-33-33-33H33Zm82.099 41h-43v23h-22v17.721c0 2.7329494 1.1181691 5.3468984 3.095 7.234L72.099 107h-22v22h22v23h43v-23h22v-17.721c0-2.732949-1.118169-5.346898-3.095-7.234L115.099 86h22V64h-22V41Zm0 23v22h-33c-5.523 0-10-4.477-10-10V64h43Zm0 65h-43v-22h33c5.523 0 10 4.477 10 10v12Z"/></svg>

                    <div>
                        <p class="font-medium text-white">Sevalla</p>
                        <p class="opacity-75">Host and manage your applications, databases, and static sites in a single, intuitive platform.</p>
                        <p class="font-medium mt-2">Join Sevalla today and get $50 free credits!</p>
                    </div>
                </div>
            </a>

            <a href="https://github.com/sponsors/benjamincrozat" target="_blank" data-pirsch-event='Clicked "Your company here"'>
                <div class="grid uppercase text-xs tracking-widest opacity-75 h-full place-items-center border-2 border-gray-800 border-dashed p-6 rounded-lg">
                    Your logo here
                </div>
            </a>
        </div>
    </x-section>

    <x-section class="mt-24">
        <x-slot:title>
            Wall of love
        </x-slot>

        <div class="grid mt-8 md:grid-cols-2 gap-4">
            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/1858019523577917444/SQU_Kbod_400x400.jpg"
                bio="Organizer of Laracon AU and podcast co-host."
                link="https://x.com/michaeldyrynda/status/1834328870969016687"
                name="Michael Dyrynda"
                data-pirsch-event="Clicked Michael's tweet"
            >
                <p>OK, this is kinda awesome [...] Very interested in this the more I see!</p>
            </x-tweet>

            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/951138971026952194/VEfZA8NC_400x400.jpg"
                bio="Maker of the original debug bar for Laravel."
                link="https://x.com/barryvdh/status/1836458733716803766"
                name="Barry vd. Heuvel"
                data-pirsch-event="Clicked Barry's tweet"
            >
                <p>Wow, looks nice! [...] looking forward to borrow some good ideas from you for Laravel Debugbar and Telescope Toolbar. 😁 Good luck!</p>
            </x-tweet>

            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/1838524088496594944/FMLhjUaU_400x400.jpg"
                bio="The API guy."
                link="https://x.com/JustSteveKing/status/1864580608439009606"
                name="Steve McDougall"
                data-pirsch-event="Clicked Steve's tweet"
            >
                <p>Looking forward to trying this out! [...]</p>
            </x-tweet>

            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/1581394119653474304/bqxzdiBc_400x400.jpg"
                bio="Laravel developer and Rector fan."
                link="https://x.com/SlyFireFox/status/1834202120049844562"
                name="Peter Fox"
                data-pirsch-event="Clicked Peter's tweet"
            >
                <p>This looks pretty awesome. Not been a fan of many debug bars for the reason they're just not all that nice to use. I could see myself using this.</p>
            </x-tweet>

            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/1844799448649486341/5cpINazw_400x400.jpg"
                bio="The legendary Laravel samuraï."
                link="https://x.com/LaravelJutsu/status/1834657567672332576"
                name="Ludovic Guénet"
                data-pirsch-event="Clicked Ludovic's tweet"
            >
                <p>I'd be glad to make a video out of it!</p>
            </x-tweet>
        </div>
    </x-section>

    <x-section id="roadmap" class="mt-24">
        <x-slot:title>
            Roadmap
        </x-slot>

        <div class="lg:max-w-screen-md lg:mx-auto grid gap-4 mt-8">
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
                    User accounts to sync settings, themes, favorites, and more, across projects effortlessly
                </li>
            </ul>

            <div class="mt-2 bg-gray-950/30 rounded-lg p-4 md:p-6 flex items-center md:justify-center gap-3">
                <x-heroicon-o-heart class="size-5 flex-none text-pink-500" />
                <p>Help me work full-time on the project by sponsoring it on <a href="https://github.com/sponsors/benjamincrozat" target="_blank" data-pirsch-event="Clicked GitHub Sponsors" class="font-medium underline underline-offset-4 decoration-gray-300/50">GitHub</a>.</p>
            </div>
        </div>
    </x-section>
</x-app>
