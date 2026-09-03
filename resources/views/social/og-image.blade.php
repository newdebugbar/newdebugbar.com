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
                class="absolute inset-0 z-[-30] [background:linear-gradient(112deg,transparent_30%,rgb(124_58_237_/_13%)_53%,transparent_73%),radial-gradient(ellipse_680px_390px_at_78%_24%,rgb(139_92_246_/_30%),transparent_70%),radial-gradient(ellipse_560px_290px_at_8%_104%,rgb(76_29_149_/_24%),transparent_72%),#07070a]"
                aria-hidden="true"
            ></div>

            <div
                class="absolute inset-0 z-[-20] opacity-[0.34] [background-image:linear-gradient(rgb(255_255_255_/_6%)_1px,transparent_1px),linear-gradient(90deg,rgb(255_255_255_/_6%)_1px,transparent_1px)] [background-size:48px_48px] [-webkit-mask-image:radial-gradient(circle_at_84%_18%,black,transparent_58%)] [mask-image:radial-gradient(circle_at_84%_18%,black,transparent_58%)]"
                aria-hidden="true"
            ></div>

            <div
                class="absolute -top-[506px] -right-[264px] z-[-10] size-[760px] rounded-full border border-violet-200/15 shadow-[0_0_0_86px_rgb(196_181_253_/_4%),0_0_0_172px_rgb(196_181_253_/_2%)]"
                aria-hidden="true"
            ></div>

            <h1 class="absolute top-14 left-16 z-10 m-0 w-[1040px] text-[78px] leading-[0.94] [font-weight:650] tracking-[-0.058em] text-zinc-50">
                Laravel,<br>
                show your <span class="text-violet-300 [text-shadow:0_0_38px_rgb(124_58_237_/_30%)]">work.</span>
            </h1>

            <p class="absolute top-[232px] left-[68px] z-10 m-0 w-[980px] text-[27px] leading-[1.35] [font-weight:450] tracking-[-0.018em] text-zinc-300">
                See what happened. Give your coding agent the same evidence.
            </p>

            <div
                class="absolute top-[296px] -left-5 z-0 h-[330px] w-[1240px] rotate-[-1.1deg] bg-[radial-gradient(ellipse_at_52%_8%,rgb(196_181_253_/_50%)_0%,rgb(124_58_237_/_31%)_36%,rgb(76_29_149_/_14%)_55%,transparent_74%)] blur-[30px]"
                aria-hidden="true"
            ></div>

            <div class="absolute top-[350px] left-5 z-10 w-[1160px] origin-top rounded-[21px] bg-[linear-gradient(104deg,rgb(255_255_255_/_32%),rgb(196_181_253_/_62%)_44%,rgb(255_255_255_/_14%))] p-0.5 [box-shadow:0_34px_76px_rgb(0_0_0_/_72%),0_0_58px_rgb(124_58_237_/_32%)] [transform:perspective(1400px)_rotateX(2deg)_rotateZ(-1.1deg)]">
                <div class="overflow-hidden rounded-[19px] bg-[#0b0b0e] shadow-[inset_0_1px_rgb(255_255_255_/_8%)]">
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
        </main>
    </body>
</html>
