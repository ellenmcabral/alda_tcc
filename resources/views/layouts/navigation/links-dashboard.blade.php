<nav class="items-center gap-8 hidden 2xl:flex">
    <!-- Navigation Links -->

    @role('artisan')
        <x-link-navigation :href="route('artisan.index')"
                           :color="'secondary'"
                           :active="request()->routeIs('artisan.index')">
            Início
        </x-link-navigation>

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
        <x-link-navigation :href="route('admin.index')"
                           :color="'secondary'"
                           :active="request()->routeIs('admin.index')">
            Início
        </x-link-navigation>

        <x-link-navigation :href="route('admin.users.index')"
                           :color="'secondary'"
                           :active="request()->routeIs('admin.users.index')">
            Usuários
        </x-link-navigation>

        <x-link-navigation :href="route('admin.shops.index')"
                           :color="'secondary'"
                           :active="request()->routeIs('admin.shops.index')">
            Lojas
        </x-link-navigation>
    @endrole
</nav>
