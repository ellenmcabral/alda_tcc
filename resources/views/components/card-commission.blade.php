<article {{ $attributes->merge([
    'class' => 'rounded-lg p-4 border border-gray-200 grid gap-4'
]) }}>
    <header class="flex justify-between">
        <p>
            <i class="fa-solid fa-hashtag"></i> {{ $id }}
        </p>

        {{ $status }}
    </header>

    <hr/>

    <div>
        {{ $content }}
    </div>

    <div class="flex justify-end">
        <x-link href="{{ $link }}">
            {{ $action }} <i class="fa-solid text-sm fa-chevron-right text-secondary-regular"></i>
        </x-link>
    </div>

</article>
