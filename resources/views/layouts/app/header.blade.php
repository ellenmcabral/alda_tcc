<header class="sticky top-0 z-50 shadow-md flex justify-between items-center py-8 px-4 bg-secondary-regular">
    <div class="flex md:w-1/2 2xl:w-1/3">
        <x-dropdown :links="'app'"/>

        <x-application-logo/>

        <!-- Search Bar -->
        <search class="ml-4 hidden lg:inline-block w-full">
            @include('layouts.search')
        </search>

        <a class="lg:ml-4 lg:hidden flex items-center"
           href="{{ route('search', ['search_text' => '', 'search_type' => 'Produtos']) }}">
            <i class="fa-lg text-neutral-white hover:text-gray-regular transition ease-in-out duration-300
                fa-solid fa-magnifying-glass"></i>
        </a>
    </div>

    <div class="flex items-center gap-6">
        @auth
            @role('artisan')
            <a class="2xl:flex uppercase text-center py-2 px-4 font-bold text-neutral-black bg-accent-regular rounded-lg hover:bg-accent-dark transition duration-300 ease-in-out"
               href="{{ route('artisan.index') }}">
                Painel
            </a>
            @elserole('admin')
            <a class="2xl:flex uppercase text-center py-2 px-4 font-bold text-neutral-black bg-accent-regular rounded-lg hover:bg-accent-dark transition duration-300 ease-in-out"
               href="{{  route('admin.index') }}">
                Painel
            </a>
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
            <a class="2xl:hidden uppercase text-center py-2 px-4 font-bold text-neutral-black bg-accent-regular rounded-lg hover:bg-accent-dark transition duration-300 ease-in-out"
               href="{{ route('register') }}">
                Criar conta
            </a>
        @endauth

        <!-- Navigation Links -->
        @include('layouts.navigation.links-app')

        @auth
            <!-- Authentication -->
            <form class="hidden md:flex items-center"
                  method="POST"
                  action="{{ route('logout') }}">
                @csrf

                <x-link-navigation :href="route('logout')"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fa-xl text-neutral-white fa-solid fa-right-from-bracket"></i>
                </x-link-navigation>
            </form>
        @endauth
    </div>
</header>
