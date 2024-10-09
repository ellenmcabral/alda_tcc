<nav class="2xl:hidden 2xl:w-full flex items-center mr-4" x-data="{ open: false }">
    <!-- Settings Dropdown -->
    <x-dropdown>
        <x-slot name="trigger">
            <!-- Hamburger -->
            <button class="flex items-center rounded-md transition">
                <svg class="text-neutral-white z-50 h-10 w-10" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'text-secondary-regular fixed': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>
        <x-slot name="content">
            @auth <!-- LOGGED IN -->
                <p class="pt-24 pb-2 px-6">
                    Oi, {{ Auth::user()->formatName() }}!
                </p>

                <hr/>

                <x-dropdown-link :href="route('home')">
                    <i class="text-accent-regular mr-1 fa-solid fa-house"></i>
                    Início
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('search', ['search_type' => 'Lojas', 'search_text' => ''])">
                    <i class="text-accent-regular mr-1 fa-solid fa-store"></i>
                    Lojas
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('profile.show')">
                    <i class="text-accent-regular mr-1 fa-solid fa-user"></i>
                    Minha Conta
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link class="flex items-center" :href="route('cart')">
                    <i class="text-accent-regular mr-2 fa-solid fa-bag-shopping"></i>
                    Sacola de Compras
                    @if(\Cart::content()->isNotEmpty())
                        <span class="ml-3 font-extrabold text-sm text-neutral-white bg-secondary-dark h-4 w-4 flex items-center justify-center rounded-full">
                                {{ \Cart::content()->count() }}
                            </span>
                    @endif
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('commissions.index')">
                    <i class="text-accent-regular mr-1 fa-solid fa-box-open"></i>
                    Meus Pedidos
                </x-dropdown-link>

                <hr/>

                @can('create shop')
                    <x-dropdown-link class="text-secondary-regular hover:text-secondary-dark font-bold" :href="route('shop.create')">
                        <i class="text-secondary-regular mr-1 fa-solid fa-store"></i>
                        Criar Loja
                    </x-dropdown-link>
                @elsecan('activate shop')
                    <x-dropdown-link class="text-secondary-regular font-bold" :href="route('shop.activate')">
                        <i class="text-secondary-regular mr-1 fa-solid fa-store"></i>
                        Ativar Loja
                    </x-dropdown-link>
                @endcan

                @role('artisan')
                    <x-dropdown-link class="text-secondary-regular hover:text-secondary-dark font-bold" :href="route('artisan.index')">
                        <i class="text-secondary-regular mr-1 fa-solid fa-store"></i>
                        Painel do Artesão
                    </x-dropdown-link>
                @elserole('admin')
                    <x-dropdown-link class="text-secondary-regular font-bold" :href="route('artisan.index')">
                        <i class="text-secondary-regular mr-1 fa-solid fa-store"></i>
                        Painel do Admin
                    </x-dropdown-link>
                @endrole


                <hr/>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link class="absolute bottom-0" :href="route('logout')"
                                     onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="text-gray-regular mr-1 fa-solid fa-right-from-bracket"></i>
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            @else <!-- LOGGED OUT -->
                <p class="pt-24 pb-8 px-6">
                    Olá! Bem-vinda(o) à Alda :)
                </p>

                <hr/>

                <x-dropdown-link :href="route('alda')">
                    <i class="text-accent-regular mr-1 fa-solid fa-house"></i>
                    Início
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('search', ['search_type' => 'Lojas', 'search_text' => ''])">
                    <i class="text-accent-regular mr-1 fa-solid fa-store"></i>
                    Lojas
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link class="flex items-center" :href="route('cart')">
                    <i class="text-accent-regular mr-2 fa-solid fa-bag-shopping"></i>
                    Sacola de Compras
                    @if(\Cart::content()->isNotEmpty())
                        <span class="ml-3 font-extrabold text-sm text-neutral-white bg-secondary-dark h-4 w-4 flex items-center justify-center rounded-full">
                            {{ \Cart::content()->count() }}
                        </span>
                    @endif
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('login')">
                    <i class="text-accent-regular mr-1 fa-solid fa-right-to-bracket"></i>
                    Entrar
                </x-dropdown-link>

                <hr/>

                <x-dropdown-link :href="route('register')">
                    <i class="text-accent-regular mr-1 fa-solid fa-user"></i>
                    Criar conta
                </x-dropdown-link>
            @endauth

        </x-slot>
    </x-dropdown>
</nav>
