<section class="grid gap-4">
    <header class="flex items-center gap-2">
        <i class="fa-solid fa-truck-fast"></i>
        <x-text-subheading>
            Endereço de Entrega
        </x-text-subheading>
    </header>

    @if($shippingAddresses->isEmpty()) {{-- se o usuário não possui um endereço --}}
        <p class="text-gray-dark">
            Adicione um endereço para receber a sua encomenda.
        </p>

        <div class="w-full flex justify-between items-center">
            <x-link href="{{ route('profile.shipping-address.create') }}">
                Adicionar um novo endereço
                <i class="text-sm fa-solid fa-plus"></i>
            </x-link>
        </div>
    @else {{-- se o usuário possui endereço --}}
        <p class="text-gray-dark">
            Escolha um endereço para receber a sua encomenda.
        </p>
        <div class="grid @if($shippingAddresses->count() > 1) grid-cols-2 @endif gap-4">
            @foreach($shippingAddresses as $address)
                <section class="flex flex-col gap-4 border border-1 rounded-lg p-4">
                    <div class="flex items-center">
                        <input type="radio"
                               class="focus:ring-accent-regular hover:checked:bg-accent-dark checked:bg-accent-regular checked:focus:bg-accent-regular accent-accent-regular"
                               id="{{ $address->id }}"
                               name="address_id"
                               value="{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }} />
                        <x-input-label for="{{ $address->id }}"
                                       class="ml-2"
                                       :value="'Enviar para este endereço'"/>
                    </div>

                    <ul>
                        <li>{{ $address->street }}, {{ $address->number }}</li>
                        @isset($address->complement)
                            <li>{{ $address->complement }}</li>
                        @endisset
                        <li>Bairro {{ $address->locality }}</li>
                        <li>{{ $address->city }} / {{ $address->region_code }}</li>
                        <li>{{ $address->postal_code }}</li>
                    </ul>

                    @if($address->is_default)
                        <p class="font-bold text-accent-darker">
                            Este é o seu endereço de entrega padrão.
                        </p>
                    @endif

                </section>
            @endforeach
        </div>
    @endif
</section>
