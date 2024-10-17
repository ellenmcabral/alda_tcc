<nav class="2xl:hidden 2xl:w-full flex items-center mr-4" x-data="{ open: false }">
    <!-- Settings Dropdown -->
    <x-dropdown>
        <x-slot name="trigger">
            <!-- Hamburger -->
            <button class="flex items-center rounded-md transition">
                <svg class="text-secondary-regular z-50 h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            <p class="pt-24 py-2 px-6">
                Oi, {{ Auth::user()->formatName() }}!
            </p>

            <hr/>

            @role('artisan')
                <x-dropdown-link :href="route('artisan.index')"
                                 :icon="'fa-table-columns'">
                    Painel
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('artisan.products.index')"
                                 :icon="'fa-bag-shopping'">
                    Produtos
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('artisan.commissions.index')"
                                 :icon="'fa-box-open'">
                    Encomendas
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('artisan.shop.edit')"
                                 :icon="'fa-gear'">
                    Minha Loja
                </x-dropdown-link>

            @else <!-- Admin Links -->
                <x-dropdown-link :href="route('login')">
                    Usuários
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('register')">
                    Permissões
                </x-dropdown-link>
            @endrole

            <hr/>

            <x-dropdown-link :href="route('home')"
                             :color="'secondary'"
                             :icon="'fa-house'">
                Sair do painel
            </x-dropdown-link>

            <hr/>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link class="absolute bottom-0"
                                 :href="route('logout')" :icon="'fa-right-from-bracket'"
                                 onclick="event.preventDefault();
                            this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</nav>
