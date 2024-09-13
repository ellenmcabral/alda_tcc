<header class="flex justify-between items-center py-8 px-4 sm:px-8 bg-secondary-regular">
    <div class="flex">
        @include('layouts.navigation.dropdown.app')

        <x-application-logo />

        <!-- Search Bar -->
        <search class="ml-4 hidden lg:inline-block">
            <x-form-search/>
        </search>
    </div>

    <div class="flex items-center">
        <button class="lg:hidden flex items-center">
            <i class="mr-4 sm:mr-8 text-lg sm:text-sm text-neutral-white hover:text-gray-regular transition ease-in-out duration-300
                fa-solid fa-magnifying-glass"></i>
        </button>

        <!-- Navigation Links -->
        @include('layouts.navigation.app')

        @auth
            @role('admin')
            <x-link-button class="h-8" :href="route('admin.index')">
                Painel do Admin
            </x-link-button>
            @endrole

            @role('artisan')
            <x-link-button class="h-8" :href="route('artisan.index')">
                Painel do Artesão
            </x-link-button>
            @endrole

            @can('activate shop')
                <a class="uppercase font-bold rounded-lg py-2 px-4 border-2 border-neutral-white text-neutral-white"
                   href="{{ route('shop.activate-form') }}">
                    Ativar Loja
                </a>
            @elsecan('create shop')
                <a class="uppercase text-center py-2 px-4 font-bold text-neutral-white border-solid border-2 border-neutral-white rounded-lg hover:bg-gray-light hover:bg-opacity-10 transition duration-300"
                   href="{{ route('shop.create') }}">
                    Criar Loja
                </a>
            @endcan

        @else
            <a class="sm:hidden sm:ml-8 uppercase text-center py-2 px-4 font-bold text-neutral-black bg-accent-regular rounded-lg hover:bg-accent-light transition duration-300"
               href="{{ route('register') }}">
                Criar conta
            </a>
        @endauth

    </div>
</header>
