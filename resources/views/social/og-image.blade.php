<!DOCTYPE html>
<html lang="en" data-theme="dark" class="bg-[#07070a]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=1200, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <title>New Debug Bar social preview</title>

        @fonts
        @vite('resources/css/app.css')

        <style>
            html,
            body {
                width: 1200px;
                min-width: 1200px;
                height: 630px;
                min-height: 630px;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="bg-[#07070a] font-sans antialiased">
        <main
            class="relative isolate h-[630px] w-[1200px] overflow-hidden bg-[#07070a] text-white [background:radial-gradient(circle_at_73%_47%,rgb(119_87_255_/_22%),transparent_31.25rem),radial-gradient(circle_at_18%_87%,rgb(76_29_149_/_12%),transparent_28rem),#07070a]"
            data-social-preview-canvas
            data-social-preview-width="1200"
            data-social-preview-height="630"
        >
            <h1 class="absolute top-[66px] left-[72px] w-[930px] text-[68px] leading-[0.96] font-semibold tracking-[-0.055em] text-zinc-50">
                See exactly what<br>
                Laravel did.
            </h1>

            <p class="absolute top-[224px] left-[72px] w-[1050px] text-[26px] leading-9 text-zinc-300">
                Requests, queries, timings, and exact context for your coding agent.
            </p>

            <div class="absolute top-[344px] left-10 w-[1120px] rounded-2xl bg-[#0d0d10] shadow-[0_1.75rem_3.25rem_rgb(0_0_0_/_60%)] ring-2 ring-white/[0.16] before:absolute before:-top-6 before:-right-6 before:-left-6 before:h-[15rem] before:z-[-1] before:rounded-[45%] before:bg-[rgb(124_58_237_/_28%)] before:blur-[42px] before:content-['']">
                <img
                    class="block h-auto w-full rounded-[14px]"
                    src="{{ Vite::asset('resources/images/screenshots/queries-inspector-desktop-dark.png') }}"
                    width="1536"
                    height="640"
                    alt="The New Debug Bar Queries inspector showing a repeated query pattern that may be an N+1 query"
                    decoding="sync"
                    fetchpriority="high"
                    data-request-inspector-image
                    data-request-inspector-theme="dark"
                    data-request-inspector-view="queries"
                >
            </div>
        </main>
    </body>
</html>
