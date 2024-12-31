<x-app>
    <div class="flex pt-8 pl-4 overflow-hidden md:pt-16 lg:justify-center lg:px-4">
        <img src="{{ Vite::asset('resources/img/hero.webp') }}" alt="The new debug bar for Laravel" class="rounded-t max-w-none flex-none w-[175dvw] md:w-[115dvw] lg:w-full xl:w-[85dvw]" style="mask-image: linear-gradient(to top, transparent, black 70%); -webkit-mask-image: linear-gradient(to top, transparent, black 70%)" />
    </div>

    <div class="container -mt-10 text-center md:max-w-screen-sm">
        <h1>
            <a wire:navigate href="{{ route('home') }}" data-pirsch-event="Clicked the logo">
                <img src="{{ Vite::asset('resources/img/logo.webp') }}" alt="{{ config('app.name') }}" class="h-48 mx-auto md:h-56" />
            </a>
        </h1>

        <div class="mt-8 max-w-[480px] mx-auto">
            <livewire:subscription-form />
        </div>

        <x-heroicon-o-arrow-up class="mx-auto mt-6 size-5" />

        <p class="mt-2 text-xs font-medium tracking-widest uppercase">
            {{ trans_choice(':count subscriber|:count subscribers', $subscribersCount) }}
        </p>

        <div class="flex items-center justify-center mt-3">
            @forelse ($subscribersGravatarsHashes as $gravatarHash)
                <img src="https://www.gravatar.com/avatar/{{ $gravatarHash }}?s=80&d=mp" class="-ml-1 bg-black rounded-full size-8 md:size-10" />
            @empty
                @foreach (range(1, 10) as $i)
                    @php
                    $bgColors = collect([
                        'bg-amber-500', 'bg-blue-500', 'bg-cyan-500', 'bg-emerald-500', 'bg-fuchsia-500', 'bg-green-500', 'bg-indigo-500', 'bg-lime-500', 'bg-orange-500', 'bg-pink-500', 'bg-purple-500', 'bg-red-500', 'bg-rose-500', 'bg-sky-500', 'bg-teal-500', 'bg-violet-500', 'bg-yellow-500',
                    ]);
                    @endphp

                    <div class="-ml-1 rounded-full size-8 md:size-10 {{ $bgColors->random() }}"></div>
                @endforeach
            @endforelse
        </div>
    </div>

    <x-section id="sponsors" class="mt-24 xl:!max-w-screen-lg">
        <x-slot:title>
            Sponsors
        </x-slot>

        <div class="grid gap-4 mt-8 md:grid-cols-2">
            <a href="https://sevalla.com?ref=newdebugbar.com" target="_blank" data-pirsch-event="Clicked Sevalla">
                <div class="flex h-full gap-5 p-4 rounded-lg bg-gray-950/30 md:p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 186" class="h-8 flex-none fill-[#F97315] mt-1"><path fill="#F97315" fill-rule="evenodd" d="M33 0C14.775 0 0 14.775 0 33v120c0 18.225 14.775 33 33 33h126c18.226 0 33-14.775 33-33V33c0-18.225-14.774-33-33-33H33Zm82.099 41h-43v23h-22v17.721c0 2.7329494 1.1181691 5.3468984 3.095 7.234L72.099 107h-22v22h22v23h43v-23h22v-17.721c0-2.732949-1.118169-5.346898-3.095-7.234L115.099 86h22V64h-22V41Zm0 23v22h-33c-5.523 0-10-4.477-10-10V64h43Zm0 65h-43v-22h33c5.523 0 10 4.477 10 10v12Z"/></svg>

                    <div>
                        <p class="font-medium text-white underline underline-offset-4 decoration-white/50 decoration-1">Sevalla</p>
                        <p class="opacity-75">Host and manage your applications, databases, and static sites in a single, intuitive platform.</p>
                        <p class="mt-2 font-medium text-white"><span class="underline underline-offset-4 decoration-white/50 decoration-1">Join Sevalla</span> today and get $50 free credits!</p>
                    </div>
                </div>
            </a>

            <a href="https://github.com/sponsors/benjamincrozat" target="_blank" data-pirsch-event='Clicked "Your company here"'>
                <div class="grid h-full p-6 text-xs tracking-widest uppercase border-2 border-gray-800 border-dashed rounded-lg opacity-75 place-items-center">
                    Your logo here
                </div>
            </a>
        </div>
    </x-section>

    <x-section id="roadmap" class="mt-24">
        <x-slot:title>
            Roadmap
        </x-slot>

        <div class="grid gap-4 mt-8 lg:max-w-screen-md lg:mx-auto">
            <h3 class="text-xl font-medium">Version 1.0 (Q1 2025)</h3>

            <h4 class="font-medium">A modern UI</h4>

            <ul class="grid gap-2 pl-4 ml-4 list-disc">
                <li class="line-through opacity-55">
                    Light and dark mode!
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Sleek and streamlined user interface
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Works on all screen sizes, even mobile!
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    A command palette that supports fuzzy search for fast developers
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    A floating widget with glanceable information that you can position anywhere
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>
            </ul>

            <h4 class="font-medium">Customization</h4>

            <ul class="grid gap-2 pl-4 ml-4 list-disc">
                <li class="line-through opacity-55">
                    Pin your favorite workspaces
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li>
                    Customize parts of the debug bar like the info bar or the floating widget.
                </li>

                <li>
                    Create your own workspaces in the easiest way possible
                </li>
            </ul>

            <h4 class="font-medium">Workspaces</h4>

            <ul class="grid gap-2 pl-4 ml-4 list-disc">
                <li class="line-through opacity-55">
                    Cache
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
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

                <li class="line-through opacity-55">
                    Models
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li>
                    Notifications
                </li>

                <li class="line-through opacity-55">
                    Queries
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Request
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Route
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>

                <li class="line-through opacity-55">
                    Views
                    <x-heroicon-o-check class="size-5 inline translate-y-[-.15rem]" />
                </li>
            </ul>

            <h3 class="text-xl font-medium">Beyond version 1.0</h3>

            <ul class="grid gap-2 pl-4 ml-4 list-disc">
                <li>
                    AI-assisted debugging (use your OpenAI API key)
                </li>

                <li>
                    User accounts to sync settings, themes, favorites, and more, across projects effortlessly
                </li>
            </ul>

            <a
                href="https://github.com/sponsors/benjamincrozat"
                target="_blank"
                data-pirsch-event="Clicked Sponsorship CTA"
                class="inline-block gap-3 px-4 py-3 mt-4 font-medium text-white bg-blue-600 rounded-lg justify-self-center"
            >
                Sponsor on GitHub
            </a>
        </div>
    </x-section>

    <x-section class="mt-24 !max-w-none !px-0">
        <x-slot:title>
            Wall of love
        </x-slot>

        <div class="flex snap-mandatory snap-x gap-4 mt-8 overflow-x-auto [&>a]:flex-none [&>a]:w-[85dvw] sm:[&>a]:w-[75dvw] md:[&>a]:w-[60dvw] lg:[&>a]:w-[45dvw] xl:[&>a]:w-[40dvw] [&>a]:scroll-ml-4 [&>a]:snap-start px-4">
            <x-tweet
                avatar="https://pbs.twimg.com/profile_images/1858019523577917444/SQU_Kbod_400x400.jpg"
                bio="Organizer of Laracon AU and podcast co-host."
                link="https://x.com/michaeldyrynda/status/1834328870969016687"
                name="Michael Dyrynda"
                data-pirsch-event="Clicked Michael's tweet"
                class="flex-none"
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
</x-app>
