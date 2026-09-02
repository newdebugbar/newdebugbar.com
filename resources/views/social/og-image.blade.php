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
            class="relative isolate h-[630px] w-[1200px] overflow-hidden bg-[#07070a] text-white [background:radial-gradient(circle_at_73%_47%,rgb(119_87_255_/_16%),transparent_31.25rem),radial-gradient(circle_at_18%_87%,rgb(76_29_149_/_8%),transparent_28rem),#07070a]"
            data-social-preview-canvas
            data-social-preview-width="1200"
            data-social-preview-height="630"
        >
            <h1 class="absolute top-[72px] left-[72px] w-[930px] text-[64px] leading-none font-semibold tracking-[-0.055em] text-zinc-50">
                Debug Laravel<br>
                without the guesswork.
            </h1>

            <p class="absolute top-[230px] left-[72px] w-[880px] text-[23px] leading-8 text-zinc-400">
                Inspect anything in one place. Give your coding agent exact context.
            </p>

            <div class="absolute top-[340px] left-[72px] w-[1056px] before:absolute before:inset-[8%_7%_32%] before:z-[-1] before:rounded-[50%] before:bg-[rgb(124_58_237_/_13%)] before:blur-[5rem] before:content-['']">
                <img
                    class="block h-auto w-full drop-shadow-[0_1.75rem_2.5rem_rgb(0_0_0_/_48%)]"
                    src="{{ Vite::asset('resources/images/screenshots/request-inspector-desktop-dark.png') }}"
                    width="1536"
                    height="780"
                    alt="The New Debug Bar Requests inspector showing exact Laravel request data"
                    decoding="sync"
                    fetchpriority="high"
                    data-request-inspector-image
                    data-request-inspector-theme="dark"
                >
            </div>
        </main>
    </body>
</html>
