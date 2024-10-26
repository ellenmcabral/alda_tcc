@role('artisan') <!-- ARTISAN LINKS -->
    <x-dropdown-link :href="route('artisan.index')"
                     :icon="'fa-table-columns'"
                     :active="request()->routeIs('artisan.index')">
        Painel
    </x-dropdown-link>

    <hr/>

    <x-dropdown-link :href="route('artisan.products.index')"
                     :icon="'fa-bag-shopping'"
                     :active="request()->routeIs('artisan.products.index')">
        Produtos
    </x-dropdown-link>

    <hr/>

    <x-dropdown-link :href="route('artisan.commissions.index')"
                     :icon="'fa-box-open'"
                     :active="request()->routeIs('artisan.commissions.index')">
        Encomendas
    </x-dropdown-link>

    <hr/>

    <x-dropdown-link :href="route('artisan.shop.edit')"
                     :icon="'fa-gear'"
                     :active="request()->routeIs('artisan.shop.edit')">
        Minha Loja
    </x-dropdown-link>

@else <!-- ADMIN LINKS -->
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
