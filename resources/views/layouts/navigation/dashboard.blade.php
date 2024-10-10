<nav class="items-center gap-8 hidden 2xl:flex">

    <!-- Navigation Links -->
    <x-nav-link :href="route('artisan.index')"
                :color="'secondary'"
                :active="request()->routeIs('artisan.index')">
        Início
    </x-nav-link>

    @role('artisan')
        <x-nav-link :href="route('artisan.shop.settings')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.shop.settings')">
            Minha Loja
        </x-nav-link>

        <x-nav-link :href="route('artisan.products.index')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.products.index')">
            Produtos
        </x-nav-link>

        <x-nav-link :href="route('artisan.commissions.index')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.commissions.index')">
            Encomendas
        </x-nav-link>

    @else <!-- Admin Links -->
        <x-nav-link
            :href="route('login')"
            :color="'secondary'"
            :active="request()->routeIs('login')">
            Usuários
        </x-nav-link>

        <x-nav-link
            :href="route('register')"
            :color="'secondary'"
            :active="request()->routeIs('register')">
            Permissões
        </x-nav-link>
    @endrole
</nav>
