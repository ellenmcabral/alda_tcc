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
<body class="flex flex-col h-screen font-sans">
    <!-- Page Header -->
    @include('layouts.app.header')

    <!-- Page Content -->
    <main class="flex-grow">
        <section class=" bg-secondary-regular flex items-center justify-center sm:h-screen">
            <div class="sm:w-2/3 mx-4 my-16 flex flex-col items-center gap-8 lg:flex-row-reverse lg:justify-center">
                <img class="md:w-1/2" src="/img/assets/shop.png"
                     alt="imagem de uma loja ilustrada" />

                <div class="grid gap-4">
                    <h1 class="font-extrabold text-4xl text-neutral-white">Uma plataforma acolhedora para artesãos</h1>
                    <p class="text-neutral-white">Adicione produtos, organize encomendas e divulgue a sua loja com a Alda</p>
                    <div class="flex flex-col items-center xl:flex-row gap-4">
                        <a class="w-full xl:w-fit uppercase text-center py-2 px-4 font-bold text-secondary-regular bg-neutral-white rounded-lg hover:bg-gray-light transition duration-300"
                           href="{{ route('register') }}">
                            Começar agora
                            <i class="ml-2 fa-solid fa-chevron-right"></i>
                        </a>
                        <a class="w-full xl:w-fit uppercase text-center py-2 px-4 font-bold text-neutral-white border-solid border-2 border-neutral-white rounded-lg hover:bg-gray-light hover:bg-opacity-10 transition duration-300"
                           href="{{ route('login') }}">
                            Já tenho uma conta
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section class="py-16 md:h-screen bg-gray-light flex items-center justify-center px-4 lg:px-16">
            <div class="grid gap-16 md:gap-8 md:grid-cols-3">
                <div class="flex flex-col justify-between p-4 bg-white rounded-lg shadow-md">
                    <img class="w-1/2"
                         src="/img/assets/online-shop.png"
                         alt="ilustração de uma loja com um carrinho de compras"/>
                    <h2 class="font-bold text-3xl text-neutral-black">
                        Abra sua loja
                    </h2>
                    <div class="w-32 h-1 bg-accent-regular my-4"></div>
                    <p>
                        Seus produtos vão ficar na página da sua loja e acessíveis para qualquer um na internet conseguir ver e comprar.
                    </p>
                </div>
                <div class="flex flex-col justify-between p-4 bg-white rounded-lg shadow-md">
                    <img class="w-1/2"
                         src="/img/assets/online-payment.png"
                         alt="ilustração de uma loja"/>
                    <h2 class="font-bold text-3xl text-neutral-black">
                        Venda com praticidade
                    </h2>
                    <div class="w-32 h-1 bg-accent-regular my-4"></div>
                    <p>
                        Você vai conseguir organizar seus produtos rapidamente com nossa interface limpa e sem complicação.
                    </p>
                </div>
                <div class="flex flex-col justify-between p-4 bg-white rounded-lg shadow-md">
                    <img class="w-1/2"
                         src="/img/assets/worldwide-shopping.png"
                         alt="ilustração de uma loja"/>
                    <h2 class="font-bold text-3xl text-neutral-black">
                        Faça parte da comunidade
                    </h2>
                    <div class="w-32 h-1 bg-accent-regular my-4"></div>
                    <p>
                        Pesquise por artesanato de vários outros locais. Crochê, biscuit ou madeira: Todos os tipos de artesanato são bem-vindos.
                    </p>
                </div>
            </div>
        </section>

        <!-- Call To Action -->
        <section class="h-screen mx-4 py-16 flex flex-col sm:flex-row items-center">
            <img class="h-fit sm:w-1/3 mb-8"
                 src="img/assets/order-placed.png"
                 alt="ilustração de uma loja" />
            <div class="grid gap-4 h-fit">
                <h1 class="text-secondary-regular font-extrabold text-4xl">Artesão, venha abrir a sua loja na Alda</h1>
                <a class="h-fit lg:w-fit uppercase text-center font-bold text-neutral-white border-solid bg-secondary-regular hover:bg-secondary-dark p-3 rounded-lg transition duration-300"
                   href="{{ route('register') }}">
                    Começar agora
                    <i class="ml-2 fa-solid fa-chevron-right"></i>
                </a>
            </div>
        </section>
    </main>

    <!-- Page Footer -->
    <footer class="static bottom-0 text-neutral-white bg-secondary-regular p-16 flex justify-center items-center">
        2024 &#169; Alda
    </footer>
</body>
</html>




