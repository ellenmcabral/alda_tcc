<nav class="items-center gap-8 hidden sm:flex sm:justify-between">
    <!-- Navigation Links -->
    @auth <!-- LOGGED IN -->
        <x-nav-link
            :href="route('home')"
            :active="request()->routeIs('home')">
            Início
        </x-nav-link>

        <x-nav-link class="ml-8"
                    :href="route('profile.edit')"
                    :active="request()->routeIs('profile.edit')">
            Minha Conta
        </x-nav-link>

        <x-nav-link class="ml-8"
                    :href="route('commissions.index')"
                    :active="request()->routeIs('commissions.index')">
            Minhas Encomendas
        </x-nav-link>

        <x-nav-link class="ml-8"
                    :href="route('cart')"
                    :active="request()->routeIs('cart')">
            Sacola de Compras
            @if(\Cart::content()->isNotEmpty())
                <span class="text-xs ml-2 font-extrabold shadow-md bg-secondary-300 h-4 w-4 flex items-center justify-center rounded-full">
                    {{ \Cart::content()->count() }}
                </span>
            @endif
        </x-nav-link>

        <!-- Authentication -->
        <form class="flex items-center ml-8" method="POST" action="{{ route('logout') }}">
            @csrf

            <x-nav-link class="h-full" :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-nav-link>
        </form>
    @else <!-- LOGGED OUT -->
        <x-nav-link
            :href="route('alda')"
            :active="request()->routeIs('alda')">
            Início
        </x-nav-link>

        <x-nav-link :href="route('search-results')"
                    :active="request()->routeIs('search-results')">
            Lojas
        </x-nav-link>

        <x-nav-link :href="route('cart')"
                    :active="request()->routeIs('cart')">
            Sacola
            @if(\Cart::content()->isNotEmpty())
                <span class="text-xs ml-2 font-extrabold shadow-md bg-secondary-300 h-4 w-4 flex items-center justify-center rounded-full">
                        {{ \Cart::content()->count() }}
                    </span>
            @endif
        </x-nav-link>

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
