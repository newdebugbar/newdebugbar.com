<section {{ $attributes->class('container 2xl:max-w-screen-xl') }}>
    <h2 class="text-center uppercase text-sm tracking-widest font-medium">
        {{ $title }}
    </h2>

    {{ $slot }}
</section>
