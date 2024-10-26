<nav class="items-center gap-8 hidden 2xl:flex">

    <!-- Navigation Links -->
    <x-link-navigation :href="route('artisan.index')"
                :color="'secondary'"
                :active="request()->routeIs('artisan.index')">
        Início
    </x-link-navigation>

    @role('artisan')
        <x-link-navigation :href="route('artisan.products.index')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.products.index')">
            Produtos
        </x-link-navigation>

        <x-link-navigation :href="route('artisan.commissions.index')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.commissions.index')">
            Encomendas
        </x-link-navigation>

        <x-link-navigation :href="route('artisan.shop.edit')"
                    :color="'secondary'"
                    :active="request()->routeIs('artisan.shop.edit')">
            Minha Loja
        </x-link-navigation>

    @else <!-- Admin Links -->
        <x-link-navigation
            :href="route('login')"
            :color="'secondary'"
            :active="request()->routeIs('login')">
            Usuários
        </x-link-navigation>

        <x-link-navigation
            :href="route('register')"
            :color="'secondary'"
            :active="request()->routeIs('register')">
            Permissões
        </x-link-navigation>
    @endrole
</nav>
