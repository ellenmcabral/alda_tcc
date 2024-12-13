<x-dashboard-layout>
    <x-slot:heading>
        Minha Loja
    </x-slot:heading>

    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <section class="flex flex-col items-center gap-4 lg:flex-row">
            <!-- Imagem da Loja -->
            <x-image src="{{ $shop->getImagePath() }}"
                     alt="Imagem da loja {{ $shop->name }}"
                     class="w-32 lg:w-20 rounded-full bg-gray-200" />

            <div>
                <x-text-subheading class="line-clamp-1">
                    {{ $shop->name }}
                </x-text-subheading>
                <x-link-secondary href="{{ route('shop.show', $shop->url) }}">
                    {{ $shop->formatUrl() }}
                </x-link-secondary>
            </div>
        </section>

        <section>
            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.information') }}">
                Informações
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.customization') }}">
                Personalização
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>

            <a class="flex justify-between items-center px-4 py-8 text-secondary-regular font-bold text-lg hover:bg-gray-100 transition duration-300"
               href="{{ route('artisan.shop.address.edit') }}">
                Endereço
                <i class="fa-solid fa-pen text-gray-regular"></i>
            </a>

            <hr/>
        </section>

        @include('artisan.shop.partials.delete-shop-form')
    </div>
</x-dashboard-layout>
