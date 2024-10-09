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
    <body class="flex flex-col font-sans text-neutral-black bg-neutral-white h-screen">
        <!-- Page Header -->
        @include('layouts.app.header')

        @isset($heading)
            <x-text-heading class="w-full px-4 py-8 lg:px-6 bg-gray-light text-gray-dark">
                {{ $heading }}
            </x-text-heading>
        @endisset

        @isset($breadcrumbs)
            <section class="w-full px-4 py-8 lg:px-6 bg-gray-light">
                {{ $breadcrumbs }}
            </section>
        @endisset

        @if(request()->routeIs('home'))
            <span class="bg-secondary-regular rounded-br-xl rounded-bl-xl w-full h-48 absolute top-24 left-0 z-0">
            </span>
        @endif

        <!-- Page Content -->
        <main class="flex-grow mx-4 mt-10 pb-16 flex justify-center relative">
            <!-- Session Status -->
            @if(session('status') !== null)
                <x-status-message :status="session('status')" :type="session('type')"/>
            @endif

            {{ $slot }}
        </main>
    </body>
</html>
