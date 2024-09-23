<header class="flex justify-between items-center py-8 px-4 sm:px-8 bg-secondary-regular">
    <div class="flex">
        @include('layouts.navigation.dropdown.app')

        <x-application-logo />

        <!-- Search Bar -->
        <search class="ml-4 hidden lg:inline-block">
            <x-form-search/>
        </search>
    </div>

    <div class="flex items-center gap-6">
        <button class="lg:hidden flex items-center">
            <i class="text-lg text-neutral-white hover:text-gray-regular transition ease-in-out duration-300
                fa-solid fa-magnifying-glass"></i>
        </button>

        @auth
            @role('admin')
            <x-button-secondary class="h-8" :href="route('admin.index')">
                Painel do Admin
            </x-button-secondary>
            @endrole

            @role('artisan')
            <x-button-secondary class="h-8" :href="route('artisan.index')">
                Painel do Artesão
            </x-button-secondary>
            @endrole

            @can('activate shop')
                <x-button-secondary href="{{ route('shop.activate-form') }}">
                    Ativar Loja
                </x-button-secondary>
            @elsecan('create shop')
                <x-button-secondary href="{{ route('shop.create') }}">
                    Criar Loja
                </x-button-secondary>
            @endcan
        @else
            <x-button-secondary class="xl:hidden" href="{{ route('register') }}">
                Criar conta
            </x-button-secondary>
        @endauth

        <!-- Navigation Links -->
        @include('layouts.navigation.app')
    </div>
</header>
