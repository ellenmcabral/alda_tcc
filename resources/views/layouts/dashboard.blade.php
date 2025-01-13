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
        <header class="sticky top-0 z-50 shadow-md flex justify-between items-center py-8 px-4 bg-neutral-white border-b-2 border-secondary-regular">
            <div class="flex items-center gap-4">
                <x-dropdown :links="'dashboard'"/>

                <x-application-logo class="hidden lg:flex"
                                    :type="'secondary'"/>
            </div>

            <x-application-logo class="flex lg:hidden"
                                :type="'iconSecondary'"/>

            <div class="flex gap-6 items-center">
                <x-button-outlined aria-label="Sair do painel"
                                   :color="'secondary'"
                                   :href="route('home')">
                    <span class="flex items-center justify-center md:hidden h-6">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </span>
                    <span class="hidden md:flex">Sair do Painel</span>
                </x-button-outlined>

                @include('layouts.navigation.links-dashboard')

                <!-- Authentication -->
                <form class="hidden md:flex items-center"
                      method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    <x-link-navigation aria-label="Sair da conta"
                                       :href="route('logout')"
                                       :color="'secondary'"
                                       onclick="event.preventDefault();
                                       this.closest('form').submit();">
                        <i class="fa-xl fa-solid fa-right-from-bracket"></i>
                    </x-link-navigation>
                </form>
            </div>
        </header>

        @isset($heading)
            <section class="w-full px-4 py-8 lg:px-6 bg-[#FCE5ED]">
                <x-text-heading class="text-secondary-dark">
                    {{ $heading }}
                </x-text-heading>
            </section>
        @endisset

        @isset($breadcrumbs)
            <section class="w-full px-4 py-8 lg:px-6 bg-[#FCE5ED]">
                {{ $breadcrumbs }}
            </section>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow mx-4 mt-10 pb-16 flex justify-center">

            <!-- Session Status -->
            @if(session('status') !== null)
                <x-status-message :status="session('status')"
                                  :type="session('type')"/>
            @endif

            {{ $slot }}
        </main>
    </body>
</html>
