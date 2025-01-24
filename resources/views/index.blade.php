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
<body class="flex flex-col font-sans antialiased">

    <!-- Page Header -->
    @include('layouts.app.header')

    <!-- Page Content -->
    <main class="flex-grow">
        <section id="shop"
                 class="py-16 bg-secondary-regular flex items-center justify-center lg:h-screen">
            <div class=" mx-4 my-16 flex flex-col items-center gap-8 lg:flex-row-reverse lg:justify-center">
                <x-image class="md:w-1/3"
                         src="/img/assets/shop.png"
                         alt="Ilustração de uma loja on-line com um carrinho de compras" />

                <div class="grid gap-8">
                    <x-text-heading class="font-extrabold text-4xl text-neutral-white">
                        Uma plataforma acolhedora para artesãos
                    </x-text-heading>
                    <x-text class="text-lg text-neutral-white">
                        Adicione produtos, organize encomendas e divulgue a sua loja com a Alda
                    </x-text>
                    <div class="flex flex-col items-center 2xl:flex-row gap-4">
                        <x-button-secondary :color="'white'"
                                            class="w-full"
                                            href="{{ route('register') }}">
                            Começar agora
                            <i class="ml-2 fa-solid fa-chevron-right"></i>
                        </x-button-secondary>
                        <x-button-outlined :color="'white'"
                                           class="w-full"
                                           href="{{ route('login') }}">
                            Já tenho uma conta
                            <i class="ml-2 fa-solid fa-chevron-right"></i>
                        </x-button-outlined>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section id="benefits"
                 class="py-16 bg-gray-light flex items-center justify-center px-4 lg:px-16 lg:h-screen">
            <div class="grid gap-16 md:gap-8 md:grid-cols-3">
                <div class="grid gap-4 justify-between p-6 bg-white rounded-lg shadow-md">
                    <x-image class="w-1/2"
                             src="/img/assets/online-shop.png"
                             alt="Ilustração de uma página web de loja com uma sacola de compras"/>
                    <x-text-subheading>
                        Abra sua loja
                    </x-text-subheading>
                    <div class="w-32 h-1 bg-accent-regular"></div>
                    <x-text>
                        Seus produtos vão ficar na página da sua loja e acessíveis para qualquer um na internet conseguir ver e comprar.
                    </x-text>
                </div>
                <div class="grid gap-4 justify-between p-6 bg-white rounded-lg shadow-md">
                    <x-image class="w-1/2"
                             src="/img/assets/online-payment.png"
                             alt="Ilustração de laptop com símbolo monetário e um carrinho de compras"/>
                    <x-text-subheading>
                        Venda com praticidade
                    </x-text-subheading>
                    <div class="w-32 h-1 bg-accent-regular"></div>
                    <x-text>
                        Você vai conseguir organizar seus produtos rapidamente com nossa interface limpa e sem complicação.
                    </x-text>
                </div>
                <div class="grid gap-4 justify-between p-6 bg-white rounded-lg shadow-md">
                    <x-image class="w-1/2"
                             src="/img/assets/worldwide-shopping.png"
                             alt="Ilustração de um globo terrestre com locais marcados em vermelho e uma sacola de compras"/>
                    <x-text-subheading>
                        Faça parte da comunidade
                    </x-text-subheading>
                    <div class="w-32 h-1 bg-accent-regular"></div>
                    <x-text>
                        Pesquise por artesanato de vários outros locais. Crochê, biscuit ou madeira: Todos os tipos de artesanato são bem-vindos.
                    </x-text>
                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <section id="cta"
                 class="mx-4 py-16 flex flex-col sm:flex-row items-center lg:h-screen">
            <x-image class="h-fit sm:w-1/3 mb-8"
                     src="img/assets/order-placed.png"
                     alt="ilustração de uma loja" />
            <div class="grid gap-4 h-fit">
                <x-text-heading class="text-secondary-regular">
                    Artesão, venha abrir a sua loja!
                </x-text-heading>

                <x-button-secondary :color="'secondary'"
                                    class="w-fit"
                                    href="{{ route('register') }}">
                    Começar agora
                    <i class="ml-2 fa-solid fa-chevron-right"></i>
                </x-button-secondary>
            </div>
        </section>
    </main>

    <!-- Page Footer -->
    @include('layouts.app.footer')
</body>
</html>




