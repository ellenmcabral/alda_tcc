<a {{ $attributes->merge([
        'class' => 'text-center font-bold rounded-lg py-2 px-4 bg-accent-darker text-neutral-white hover:bg-[#00663C] transition duration-300'
        ]) }}>

    {{ $slot }}
</a>
