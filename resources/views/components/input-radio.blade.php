@props(['checked' => false])

<input {{ $checked ? 'checked' : '' }}
    {!! $attributes->merge([
        'class' => 'cursor-pointer border border-slate-300 checked:border-slate-400 appearance-none rounded-full h-5 w-5 hover:bg-gray-light duration-300 transition-all checked:hover:bg-accent-darker focus:ring-accent-regular checked:bg-accent-dark checked:focus:bg-accent-dark'
    ]) !!}>
