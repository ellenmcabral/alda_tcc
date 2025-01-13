<header class="sticky top-0 z-50 shadow-md flex flex-col gap-4 py-8 px-4 bg-secondary-regular">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-4 w-1/3 lg:w-1/2 2xl:w-1/3">
            <x-dropdown :links="'app'"/>

            <x-application-logo class="hidden lg:flex"
                                :type="'white'"/>

            <!-- Search Bar -->
            <search class="hidden lg:inline-block w-full">
                @include('layouts.search')
            </search>
        </div>

        <x-application-logo class="flex lg:hidden"
                            :type="'iconWhite'"/>

        <div class="w-1/3 2xl:w-1/2 flex items-center justify-end 2xl:gap-6">

            <!-- Navigation Links -->
            @include('layouts.navigation.links-app')

            @auth
                @role('artisan')
                <x-button-secondary aria-label="Painel do artesão" href="{{ route('artisan.index') }}">
                    <span class="flex items-center justify-center md:hidden h-6">
                            <i class="fa-solid fa-table-columns"></i>
                        </span>
                    <span class="hidden md:flex">Painel do Artesão</span>
                </x-button-secondary>
                @elserole('admin')
                <x-button-secondary aria-label="Painel do admin" href="{{  route('admin.index') }}">
                    <span class="flex items-center justify-center md:hidden h-6">
                            <i class="fa-solid fa-table-columns"></i>
                        </span>
                    <span class="hidden md:flex">Painel do Admin</span>
                </x-button-secondary>
                @endrole

                @can('activate shop')
                    <x-button-secondary href="{{ route('shop.activate') }}">
                        <span class="flex items-center justify-center md:hidden h-6">
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="hidden md:flex">Ativar loja</span>
                    </x-button-secondary>
                @elsecan('create shop')
                    <x-button-secondary aria-label="Criar loja" href="{{ route('shop.create') }}">
                        <span class="flex items-center justify-center md:hidden h-6">
                            <i class="fa-solid fa-shop"></i>
                        </span>
                        <span class="hidden md:flex">Criar loja</span>
                    </x-button-secondary>
                @endcan
            @else
                <x-button-secondary aria-label="Criar conta" class="flex 2xl:hidden"
                                    href="{{ route('register') }}">
                    <span class="flex items-center justify-center md:hidden h-6">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <span class="hidden md:flex">Criar conta</span>
                </x-button-secondary>
            @endauth

            @auth
                <!-- Authentication -->
                <form class="hidden md:flex ml-4 items-center"
                      method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <x-link-navigation aria-label="Sair da conta"
                                       :href="route('logout')"
                                       onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="fa-xl text-neutral-white fa-solid fa-right-from-bracket"></i>
                    </x-link-navigation>
                </form>
            @endauth
        </div>
    </div>

    <!-- Search Bar -->
    <search class="w-full flex-inline lg:hidden">
        @include('layouts.search')
    </search>
</header>
