<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/ab1643a237.js" crossorigin="anonymous"></script>
    </head>
    <body class="flex flex-col h-screen font-sans antialiased">
        <!-- Page Header -->
        <header class="flex justify-between items-center p-6 bg-primary-700 mb-8">
            <div class="flex">
                @include('layouts.navigation.dropdown.app')

                <a class="font-extrabold text-xl"
                   href="@auth {{ route('home') }} @else {{ route('alda') }} @endauth">
                    Alda
                </a>
            </div>

            <div class="flex items-center">
                @auth
                    @role('admin')
                    <x-link-button class="h-8" :href="route('admin.index')">
                        Painel do Admin
                    </x-link-button>
                    @endrole

                    @role('artisan')
                    <x-link-button class="h-8" :href="route('artisan.index')">
                        Painel do Artesão
                    </x-link-button>
                    @endrole

                    @can('activate shop')
                        <x-link-button class="h-8" :href="route('shop.activate-form')">
                            Ativar Loja
                        </x-link-button>
                    @elsecan('create shop')
                        <x-link-button class="h-8" :href="route('shop.create')">
                            Criar Loja
                        </x-link-button>
                    @endcan
                @endauth

                @include('layouts.navigation.app')
            </div>
        </header>

        <!-- Session Status -->
        @if(session('status') !== null)
            <div class="mx-4 relative">
                @if(session('status') == 'profile-updated')
                    <x-status-message :type="'success'">
                        Perfil alterado com sucesso.
                    </x-status-message>
                @elseif(session('status') == 'verification-link-sent')
                    <x-status-message :type="'success'">
                        Um novo e-mail de verificação foi enviado para o e-mail que você inseriu.
                    </x-status-message>
                @elseif(session('status') === 'product-added')
                    <x-status-message :type="'success'">
                        Produto adicionado na sua sacola de compras.
                    </x-status-message>
                @elseif(session('status') === 'product-not-added')
                    <x-status-message :type="'warning'">
                        Esvazie sua sacola de compras ou finalize a encomenda antes de comprar um produto desta loja.
                    </x-status-message>
                @elseif(session('status') === 'commission-stored')
                    <x-status-message :type="'warning'" :static="true">
                        Encomenda solicitada!
                        Finalize o pagamento para que o artesão possa começar a produção.
                    </x-status-message>
                @elseif(session('status') === 'commission-destroyed')
                    <x-status-message :type="'success'">
                        Encomenda cancelada com sucesso.
                    </x-status-message>
                @else
                    <x-auth-session-status :status="session('status')"/>
                @endif
            </div>
        @endif

        <!-- Search Bar -->
        @auth
            @if(!request()->routeIs('categories.products.index'))
                @if(!request()->routeIs('search-results'))
                    <search class="mx-4 mb-8">
                        <x-form-search/>
                    </search>
                @endif
            @endif
        @endauth

        <!-- Breadcrumbs -->
        @isset($breadcrumbs)
            <nav class="mx-4 mb-8">
                {{ $breadcrumbs }}
            </nav>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow mx-4">

            <!-- Page Heading -->
            @isset($heading)
                <h1 class="font-extrabold text-4xl text-gray-800 mb-8">
                    {{ $heading }}
                </h1>
            @endisset

            {{ $slot }}
        </main>

        <!-- Page Footer -->
        <footer class="static bottom-0 bg-secondary-300 p-16 flex justify-center items-center mt-32">
            2024 &#169; Alda
        </footer>
    </body>
</html>
