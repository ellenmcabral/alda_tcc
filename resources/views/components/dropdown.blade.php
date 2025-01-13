@props(['links'])

@php

switch($links) {
    case 'app':
        $buttonColor = 'text-neutral-white';
        break;
    case 'dashboard':
        $buttonColor = 'text-secondary-regular';
        break;
}

@endphp

<nav class="2xl:hidden 2xl:w-full flex items-center" x-data="{ open: false }">
    <div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
        <div @click="open = ! open">
            <!-- Hamburger -->
            <button aria-label="Botão do menu" class="flex items-center rounded-md transition">
                <svg class="z-50 h-10 w-10 {{ $buttonColor }}"
                     stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                          stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': ! open, 'text-secondary-regular fixed': open }" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div x-show="open"
             class="absolute top-0 left-0 w-full min-h-screen"
             style="display: none;"
             @click="open = false">
            <div class="fixed z-30 h-screen w-fit bg-neutral-white">
                <p class="pt-24 py-2 px-6">
                    @auth
                        Oi, {{ Auth::user()->formatName() }}! :)
                    @else
                        Bem-vinda(o) à Alda! :)
                    @endauth
                </p>

                <hr/>

                @if($links == 'app')
                    @include('layouts.navigation.dropdown.links-app')
                @elseif($links == 'dashboard')
                    @include('layouts.navigation.dropdown.links-dashboard')
                @endif

                @auth
                    <!-- Authentication -->
                    <form method="post"
                          action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                         :icon="'fa-right-from-bracket'"
                                         onclick="event.preventDefault();
                            this.closest('form').submit();">
                            Sair da conta
                        </x-dropdown-link>
                    </form>
                @endauth
            </div>
            <div class="fixed z-20 h-screen w-full bg-black bg-opacity-25">

            </div>
        </div>
    </div>
</nav>
