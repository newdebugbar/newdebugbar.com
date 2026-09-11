@props(['steps', 'caption'])

<x-docs.figure {{ $attributes->class('mt-8') }} :caption="$caption">
    <ol class="space-y-6" data-docs-diagram>
        @foreach ($steps as $step)
            <x-docs.step :number="$loop->iteration" :title="$step['title']">
                {{ $step['description'] }}
            </x-docs.step>
        @endforeach
    </ol>
</x-docs.figure>
