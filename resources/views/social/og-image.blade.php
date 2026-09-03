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
            class="relative isolate h-[630px] w-[1200px] overflow-hidden bg-[#07070a] text-white"
            data-social-preview-canvas
            data-social-preview-width="1200"
            data-social-preview-height="630"
        >
            <div
                class="absolute inset-0 z-[-30] [background:radial-gradient(140%_125%_at_92%_8%,rgb(139_92_246_/_30%)_0%,rgb(91_33_182_/_16%)_34%,transparent_68%),radial-gradient(125%_90%_at_16%_104%,rgb(76_29_149_/_17%)_0%,transparent_64%),#07070a]"
                aria-hidden="true"
            ></div>

            <h1 class="absolute top-16 left-20 z-30 m-0 w-[1040px] text-[76px] leading-[0.95] [font-weight:650] tracking-[-0.052em] text-zinc-50">
                Debug Laravel<br>
                without the <span class="text-violet-300 [text-shadow:0_0_38px_rgb(124_58_237_/_30%)]">guesswork.</span>
            </h1>

            <p class="absolute top-[239px] left-[84px] z-30 m-0 w-[1000px] text-[26px] leading-[1.35] [font-weight:450] tracking-[-0.018em] text-zinc-300 [text-shadow:0_2px_18px_rgb(7_7_10_/_96%)]">
                See what happened. Give your coding agent the same evidence.
            </p>

            <div class="absolute top-[270px] left-[72px] z-10 w-[1050px] [transform-origin:56%_0%] [transform-style:preserve-3d] [transform:perspective(1100px)_rotateX(8deg)_rotateY(-5deg)_rotateZ(-2.6deg)]">
                <div class="absolute inset-0 translate-x-[11px] translate-y-[15px] rounded-[23px] bg-[linear-gradient(145deg,#5b21b6_0%,#211534_46%,#08080c_100%)] opacity-95 [box-shadow:-20px_52px_100px_rgb(0_0_0_/_88%),0_0_78px_rgb(124_58_237_/_38%)]" aria-hidden="true"></div>

                <div class="relative rounded-[23px] bg-[linear-gradient(110deg,rgb(255_255_255_/_38%),rgb(196_181_253_/_76%)_43%,rgb(124_58_237_/_30%)_72%,rgb(255_255_255_/_16%))] p-[3px] shadow-[inset_0_1px_rgb(255_255_255_/_22%)]">
                    <div class="overflow-hidden rounded-[20px] bg-[#0b0b0e] shadow-[inset_0_1px_rgb(255_255_255_/_9%)]">
                        <img
                            class="block h-auto w-full"
                            src="{{ Vite::asset('resources/images/screenshots/request-inspector-desktop-dark.png') }}"
                            width="1536"
                            height="780"
                            alt="The New Debug Bar Requests inspector showing a Laravel request from start to finish"
                            decoding="sync"
                            fetchpriority="high"
                            data-request-inspector-image
                            data-request-inspector-theme="dark"
                            data-request-inspector-view="requests"
                        >
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
