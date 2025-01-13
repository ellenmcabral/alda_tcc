<x-app-layout>
    <x-slot:breadcrumbs>
        @auth
            {{ Breadcrumbs::render('categories.index') }}
        @else
            {{ Breadcrumbs::render('categories.index.loggedOut') }}
        @endauth
    </x-slot:breadcrumbs>

    <div class="grid gap-8 h-fit w-full lg:px-8">
        <ul class="grid gap-4 grid-cols-2 md:grid-cols-4 xl:grid-cols-6 2xl:grid-cols-8">
            @foreach($categories as $category)
                <li>
                    <x-tag href="{{ route('categories.products.index', $category->id) }}">
                        {{ $category->description }}
                    </x-tag>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
