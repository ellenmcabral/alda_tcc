<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shipping-addresses.index') }}
    </x-slot:breadcrumbs>

    <div class="flex flex-col gap-8 w-full h-fit md:w-2/3">
        <x-button-secondary class="w-fit self-end"
                            :color="'secondary'"
                            href="{{ route('profile.shipping-addresses.create') }}">
            Adicionar
            <i class="fa-solid fa-plus"></i>
        </x-button-secondary>

        @if($addresses->isEmpty())
            <x-text class="text-gray-dark">
                Nenhum endereço de entrega.
            </x-text>
        @else
            <section class="grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
                @foreach($addresses as $address)
                    <div class="p-4 flex flex-col justify-between gap-4 border rounded-lg @if($address->is_default) border-accent-dark @else border-gray-light @endif">
                        @if($address->is_default)
                            <x-text class="font-bold text-accent-darker">
                                Este é o seu endereço de entrega padrão.
                            </x-text>

                            <hr/>
                        @endif
                        <ul>
                            <li>{{ $address->street }}</li>
                            <li>{{ $address->number }}</li>
                            @if($address->complement)
                                <li>{{ $address->complement }}</li>
                            @endif
                            <li>{{ $address->locality }}</li>
                            <li>{{ $address->city }}</li>
                            <li>{{ $address->region_code }}</li>
                            <li>{{ $address->postal_code }}</li>
                        </ul>


                        <div class="grid gap-4">
                            <hr/>

                            <div class="flex justify-between">
                                @include('profile.partials.delete-address-form')

                                <x-link class="self-end w-fit"
                                        href="{{ route('profile.shipping-addresses.edit', $address->id) }}">
                                    Editar <i class="ml-1 fa-solid fa-pen-to-square"></i>
                                </x-link>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @endif
    </div>
</x-app-layout>
