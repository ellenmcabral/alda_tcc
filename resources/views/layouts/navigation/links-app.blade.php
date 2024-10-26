<nav class="items-center gap-8 hidden 2xl:flex">
    <!-- Navigation Links -->
    @auth <!-- LOGGED IN -->
        <x-link-navigation
            :href="route('home')"
            :active="request()->routeIs('home')">
            Início
        </x-link-navigation>

        <x-link-navigation :href="route('search', ['search_type' => 'Lojas', 'search_text' => ''])"
                    :active="request()->routeIs('search', ['search_type' => 'Lojas', 'search_text' => ''])">
            Lojas
        </x-link-navigation>

        <x-link-navigation :href="route('profile.show')"
                    :active="request()->routeIs('profile.show')">
            Minha Conta
        </x-link-navigation>

        <x-link-navigation class="flex items-center gap-1"
                    :href="route('cart')"
                    :active="request()->routeIs('cart')">
            Sacola de Compras
            @if(\Cart::content()->isNotEmpty())
                <span class="text-xs font-bold bg-warning-regular text-neutral-black h-4 w-4 flex items-center justify-center rounded-full">
                    {{ \Cart::content()->count() }}
                </span>
            @endif
        </x-link-navigation>

        <x-link-navigation :href="route('commissions.index')"
                    :active="request()->routeIs('commissions.index')">
            Meus Pedidos
        </x-link-navigation>

    @else <!-- LOGGED OUT -->
        <x-link-navigation
            :href="route('alda')"
            :active="request()->routeIs('alda')">
            Início
        </x-link-navigation>

        <x-link-navigation :href="route('search', ['search_type' => 'Lojas', 'search_text' => ''])"
                    :active="request()->routeIs('search', ['search_type' => 'Lojas', 'search_text' => ''])">
            Lojas
        </x-link-navigation>

        <x-link-navigation :href="route('cart')"
                    :active="request()->routeIs('cart')">
            Sacola de Compras
            @if(\Cart::content()->isNotEmpty())
                <span class="text-xs font-bold bg-warning-regular text-neutral-black h-4 w-4 flex items-center justify-center rounded-full">
                    {{ \Cart::content()->count() }}
                </span>
            @endif
        </x-link-navigation>

        <a class="uppercase text-center py-2 px-4 font-bold text-neutral-white border-solid border-2 border-neutral-white rounded-lg hover:bg-gray-light hover:bg-opacity-10 transition duration-300"
           href="{{ route('login') }}">
            Entrar
        </a>

        <a class="uppercase text-center py-2 px-4 font-bold text-neutral-black bg-accent-regular rounded-lg hover:bg-accent-dark transition duration-300 ease-in-out"
           href="{{ route('register') }}">
            Criar conta
        </a>

    @endauth
</nav>
