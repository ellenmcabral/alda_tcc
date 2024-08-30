<nav class="z-50 sm:hidden flex items-center sm:w-full mr-4" x-data="{ open: false }">
    <!-- Settings Dropdown -->
    <x-dropdown align="right" background="secondary">
        <x-slot name="trigger">
            <!-- Hamburger -->
            <button class="flex items-center rounded-md transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
            <p class="py-2 px-6">
                Oi, {{ Auth::user()->name }}
            </p>

            @role('artisan')
                <x-dropdown-link :href="route('artisan.index')">
                    <i class="fa-solid fa-house mr-2"></i>
                    Início
                </x-dropdown-link>

                <x-dropdown-link :href="route('shop.show', Auth::user()->shop->url)">
                    <i class="fa-solid fa-store mr-2"></i>
                    Minha Loja
                </x-dropdown-link>

                <x-dropdown-link :href="route('artisan.shop.settings')">
                    <i class="fa-solid fa-gear mr-2"></i>
                    Configurações
                </x-dropdown-link>

                <x-dropdown-link class="flex items-center" :href="route('artisan.products.index')">
                    <i class="fa-solid fa-bag-shopping mr-3"></i>
                    Produtos
                </x-dropdown-link>

                <x-dropdown-link :href="route('artisan.commissions.index')">
                    <i class="fa-solid fa-box-open mr-1"></i>
                    Encomendas
                </x-dropdown-link>
            @else <!-- Admin Links -->
                <x-dropdown-link :href="route('login')">
                    Usuários
                </x-dropdown-link>

                <x-dropdown-link :href="route('register')">
                    Permissões
                </x-dropdown-link>
            @endrole

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                            this.closest('form').submit();">
                    <i class="fa-solid fa-right-from-bracket mr-1"></i> {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</nav>
