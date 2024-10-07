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
    <body class="flex flex-col font-sans h-screen bg-neutral-white text-neutral-black">
        <!-- Page Header -->
        <header class="flex justify-between items-center py-8 px-4 sm:px-8 bg-neutral-white border-b-2 border-secondary-regular">
            <div class="flex">
                @include('layouts.navigation.dropdown.dashboard')

                <x-application-logo :color="'secondary'" />
            </div>

            <div class="flex gap-6 items-center">
                <x-button-outlined :color="'secondary'"
                                   :href="route('home')">
                    Sair do Painel
                </x-button-outlined>

                @include('layouts.navigation.dashboard')
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow mx-4 mt-8 mb-16 flex justify-center">
            <!-- Session Status -->
            @if(session('status') !== null)
                <x-status-message :status="session('status')" :type="session('type')"/>
            @endif

            {{ $slot }}
        </main>

        <!-- Page Footer -->
        @include('layouts.app.footer')
    </body>
</html>
