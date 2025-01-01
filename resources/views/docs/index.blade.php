<x-docs-layout
    :$navigation
    title="Documentation"
>
    <x-prose>
        {!! Str::markdown($content) !!}
    </x-prose>
</x-docs-layout>

