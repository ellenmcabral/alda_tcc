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
        <header class="flex justify-between items-center p-6 bg-secondary-300 mb-8">
            <div class="flex">
                @include('layouts.navigation.dropdown.dashboard')

                <x-application-logo />
            </div>

            <div class="flex items-center">

                <x-link-button class="h-8" :background="'primary'" :href="route('home')">
                    Sair do Painel
                </x-link-button>

                @include('layouts.navigation.dashboard')
            </div>
        </header>

        <!-- Session Status -->
        @if(session('status') !== null)
            <div class="mx-4 relative">
                @if(session('status') === 'profile-updated')
                    <x-status-message :type="'success'">
                        Informações da loja alteradas com sucesso.
                    </x-status-message>
                @endif
            </div>
        @endif

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
        <footer class="static bottom-0 bg-primary-700 p-16 flex justify-center items-center mt-32">
            2024 &#169; Alda
        </footer>
    </body>
</html>
