@auth
    <x-dropdown-link :href="route('home')"
                     :icon="'fa-house'"
                     :active="request()->routeIs('home')">
        Início
    </x-dropdown-link>
@else
    <x-dropdown-link :href="route('alda')"
                     :icon="'fa-house'"
                     :active="request()->routeIs('alda')">
        Início
    </x-dropdown-link>
@endauth

<hr/>

<x-dropdown-link :href="route('search', ['search_type' => 'Lojas', 'search_text' => ''])"
                 :icon="'fa-store'"
                 :active="request()->routeIs('search', ['search_type' => 'Lojas', 'search_text' => ''])">
    Lojas
</x-dropdown-link>

<hr/>

@auth <!-- LOGGED IN -->
    <x-dropdown-link :href="route('profile.show')"
                     :icon="'fa-user'"
                     :active="request()->routeIs('profile.show')">
        Minha Conta
    </x-dropdown-link>

    <hr/>
@endauth

<x-dropdown-link class="flex items-center"
                 :href="route('cart')"
                 :icon="'fa-bag-shopping'"
                 :active="request()->routeIs('cart')">
    Sacola de Compras
    @if(\Cart::content()->isNotEmpty())
        <span class="ml-3 font-extrabold text-sm text-neutral-white bg-secondary-dark h-4 w-4 flex items-center justify-center rounded-full">
            {{ \Cart::content()->count() }}
        </span>
    @endif
</x-dropdown-link>

<hr/>

@auth <!-- LOGGED IN -->
    <x-dropdown-link :href="route('commissions.index')"
                     :icon="'fa-box-open'"
                     :active="request()->routeIs('commissions.index')">
        Meus Pedidos
    </x-dropdown-link>

    <hr/>

    @can('create shop')
        <x-dropdown-link :href="route('shop.create')"
                         :color="'secondary'"
                         :icon="'fa-store'"
                         :active="request()->routeIs('shop.create')">
            Criar Loja
        </x-dropdown-link>
    @elsecan('activate shop')
        <x-dropdown-link :href="route('shop.activate')"
                         :color="'secondary'"
                         :icon="'fa-store'"
                         :active="request()->routeIs('shop.activate')">
            Ativar Loja
        </x-dropdown-link>
    @endcan

    @role('artisan')
    <x-dropdown-link :href="route('artisan.index')"
                     :color="'secondary'"
                     :icon="'fa-table-columns'" >
        Painel do Artesão
    </x-dropdown-link>
    @elserole('admin')
    <x-dropdown-link :href="route('artisan.index')"
                     :color="'secondary'"
                     :icon="'fa-table-columns'">
        Painel do Admin
    </x-dropdown-link>
    @endrole

@else <!-- LOGGED OUT -->
    <x-dropdown-link :href="route('login')"
                     :icon="'fa-right-to-bracket'"
                     :active="request()->routeIs('login')">
        Entrar
    </x-dropdown-link>

    <hr/>

    <x-dropdown-link :href="route('register')"
                     :icon="'fa-user'"
                     :active="request()->routeIs('register')">
        Criar conta
    </x-dropdown-link>
@endauth
