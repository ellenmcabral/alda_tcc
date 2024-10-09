@unless ($breadcrumbs->isEmpty())
    <ol class="flex flex-wrap">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="flex items-center">
                    <a href="{{ $breadcrumb->url }}" class="text-gray-dark hover:text-neutral-black transition duration-150">
                        {{ $breadcrumb->title }}
                    </a>
                </li>
            @else
                <li class="flex items-center text-secondary-regular font-bold">
                    {{ $breadcrumb->title }}
                </li>
            @endif

            @unless($loop->last)
                <i class="text-gray-dark p-2 fa-solid fa-angle-right"></i>
            @endif

        @endforeach
    </ol>
@endunless
