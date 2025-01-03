<footer {{ $attributes->class('py-8 text-center bg-gray-950') }}>
    <nav class="container flex items-center justify-center gap-4 xl:max-w-screen-lg">
        <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the footer" class="inline-block">
            <x-icon-github class="fill-current size-5" />
        </a>

        <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the footer" class="inline-block">
            <x-icon-x class="fill-current size-5" />
        </a>
    </nav>

    <p class="mt-4 text-sm text-gray-400">
        Made with <span class="text-pink-400">♥</span> by <a href="https://x.com/benjamincrozat" target="_blank" data-pirsch-event="Clicked Benjamin's name" class="font-medium text-gray-400 underline underline-offset-4 decoration-gray-400/50">Benjamin Crozat</a>.
    </p>
</footer>
