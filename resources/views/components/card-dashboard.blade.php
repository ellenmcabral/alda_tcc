@props(['route', 'icon', 'title', 'text'])

<a {{ $attributes->merge([
        'class' => 'flex flex-col items-center rounded-xl shadow-md gap-2 p-6 bg-white transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100',
        'href' => $route,
        ]) }}>
    <i class="fa-solid {{ $icon }} text-accent-regular text-4xl"></i>

    <x-text-subheading>
        {{ $title }}
    </x-text-subheading>

    <x-text class="text-gray-dark text-center">
        {{ $text }}
    </x-text>
</a>
