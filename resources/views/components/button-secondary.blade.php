<a {{ $attributes->merge([
        'class' => 'uppercase font-bold rounded-lg py-2 px-4 border-2 border-neutral-white text-neutral-white'
        ]) }}>

    {{ $slot }}
</a>
