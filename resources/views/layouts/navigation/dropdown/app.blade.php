<nav class="sm:hidden flex items-center sm:w-full mr-4" x-data="{ open: false }">
    <!-- Settings Dropdown -->
    <x-dropdown>
        <x-slot name="trigger">
            <!-- Hamburger -->
            <button class="flex items-center rounded-md transition">
                <svg class="text-neutral-white z-40 h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'text-secondary-regular fixed': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            @auth <!-- LOGGED IN -->
                <p class="pt-24 pb-2 px-6">
                    Oi, {{ Auth::user()->name }}
                </p>

                <x-dropdown-link :href="route('home')">
                    <i class="fa-solid fa-house mr-2"></i>
                    Início
                </x-dropdown-link>

                <x-dropdown-link :href="route('profile.edit')">
                    <i class="fa-solid fa-user mr-2"></i>
                    Minha Conta
                </x-dropdown-link>

                <x-dropdown-link class="flex items-center" :href="route('cart')">
                    <i class="fa-solid fa-bag-shopping mr-3"></i>
                    Sacola de Compras
                    @if(\Cart::content()->isNotEmpty())
                        <span class="text-xs text-white ml-2 font-extrabold shadow-md bg-red h-4 w-4 flex items-center justify-center rounded-full">
                            {{ \Cart::content()->count() }}
                        </span>
                    @endif
                </x-dropdown-link>

                <x-dropdown-link :href="route('commissions.index')">
                    <i class="fa-solid fa-box-open mr-1"></i>
                    Minhas Encomendas
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            @else <!-- LOGGED OUT -->
                <p class="pt-24 pb-8 px-6">
                    Olá! Bem-vinda(o) à Alda :)
                </p>

                <hr/>

                <x-dropdown-link :href="route('alda')">
                    <i class="text-accent-regular mr-2 fa-solid fa-house"></i>
                    Início
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('alda')">
                    <i class="text-accent-regular mr-2 fa-solid fa-store"></i>
                    Lojas
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('cart')">
                    <i class="text-accent-regular mr-2 fa-solid fa-bag-shopping"></i>
                    Sacola de Compras
                    @if(\Cart::content()->isNotEmpty())
                        <span class="text-xs ml-2 font-extrabold shadow-md bg-secondary-300 h-4 w-4 flex items-center justify-center rounded-full">
                            {{ \Cart::content()->count() }}
                        </span>
                    @endif
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('login')">
                    <i class="text-accent-regular mr-2 fa-solid fa-right-to-bracket"></i>
                    Entrar
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('register')">
                    <i class="text-accent-regular mr-2 fa-solid fa-user"></i>
                    Criar conta
                </x-dropdown-link>

                <hr/>
            @endauth

        </x-slot>
    </x-dropdown>
</nav>
