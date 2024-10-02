@props(['method' => 'POST'])

<form {{ $attributes->merge([
        'class' => 'flex flex-col gap-10 w-full',
        'method' => $method,
        ]) }}>
    @csrf

    {{ $slot }}
</form>
