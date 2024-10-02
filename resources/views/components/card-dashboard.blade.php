@props(['route', 'icon', 'title', 'text'])

<a {{ $attributes->merge([
        'class' => 'flex flex-col items-center rounded-xl shadow-md p-6 bg-neutral transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-100',
        'href' => $route,
        ]) }}>
    <i class="fa-solid {{ $icon }} text-accent-regular text-4xl"></i>

    <h3 class="mt-2 font-bold text-lg">
        {{ $title }}
    </h3>

    <p class="text-gray-dark text-center">
        {{ $text }}
    </p>
</a>
