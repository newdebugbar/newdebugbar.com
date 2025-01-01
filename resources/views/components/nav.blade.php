<div {{ $attributes->class('flex items-center justify-end gap-8 text-sm md:text-base') }}>
    <a wire:navigate href="{{ route('docs.index') }}" data-pirsch-event='Clicked "Documentation" in the nav bar' @class([
        'font-medium',
        'text-blue-500' => request()->routeIs('docs.*'),
    ])>
        <span class="sr-only sm:not-sr-only">Documentation</span>
        <span class="sm:sr-only">Docs</span>
    </a>

    <a href="{{ route('home') }}#roadmap" data-pirsch-event='Clicked "Roadmap" in the nav bar' class="font-medium">Roadmap</a>

    <a href="https://github.com/newdebugbar" target="_blank" data-pirsch-event="Clicked GitHub in the nav bar" class="fill-current">
        <x-icon-github class="size-4 md:size-5" />
    </a>

    <a href="https://x.com/newdebugbar" target="_blank" data-pirsch-event="Clicked X in the nav bar" class="-ml-4 fill-current">
        <x-icon-x class="size-4 md:size-5" />
    </a>
</div>
