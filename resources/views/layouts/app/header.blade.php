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
            @role('artisan')
                <x-button-outlined :href="route('artisan.index')">
                    Painel do Artesão
                </x-button-outlined>
            @elserole('admin')
                <x-button-outlined :href="route('admin.index')">
                    Painel do Admin
                </x-button-outlined>
            @endrole

            @can('activate shop')
                <x-button-outlined href="{{ route('shop.activate') }}">
                    Ativar Loja
                </x-button-outlined>
            @elsecan('create shop')
                <x-button-outlined href="{{ route('shop.create') }}">
                    Criar Loja
                </x-button-outlined>
            @endcan
        @else
            <x-button-outlined class="xl:hidden" href="{{ route('register') }}">
                Criar conta
            </x-button-outlined>
        @endauth

        <!-- Navigation Links -->
        @include('layouts.navigation.app')
    </div>
</header>
