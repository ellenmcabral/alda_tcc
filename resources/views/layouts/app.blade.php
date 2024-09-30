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
    <body class="flex flex-col font-sans h-screen text-neutral-black">
        <!-- Page Header -->
        @include('layouts.app.header')

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
                    <x-status-message :status="session('status')" :type="'success'">
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
                    <x-status-message :status="session('status')" :type="session('type')"/>
                @endif
            </div>
        @endif

        <!-- Page Content -->
        <main class="flex-grow mx-4 mt-8 flex justify-center">
            {{ $slot }}
        </main>

        <!-- Page Footer -->
        @include('layouts.app.footer')
    </body>
</html>
