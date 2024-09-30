<x-app-layout>
    <div class="grid gap-8 w-full h-fit lg:w-1/2 xl:w-1/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('shipping-address.index') }}
        </div>

        <x-text-heading>
            Endereços de Entrega
        </x-text-heading>

        <x-link
           href="{{ route('profile.shipping-address.create') }}">
            <span class="underline">Adicionar um novo endereço</span>
            <i class="text-sm fa-solid fa-plus"></i>
        </x-link>

        <hr/>

        @if($addresses->isEmpty())
            <p class="text-gray-dark">
                Nenhum endereço de entrega cadastrado.
            </p>
        @else
            @foreach($addresses as $address)
                <section class="flex flex-col gap-8 border border-1 rounded-lg @if($address->is_default) border-accent-regular @else border-gray-light @endif p-4">
                    @if($address->is_default)
                        <p class="font-bold text-accent-darker">
                            Este é o seu endereço de entrega padrão.
                        </p>
                    @endif
                    <table class="text-left">
                        <tr>
                            <th class="w-24">Rua</th>
                            <td>{{ $address->street }}</td>
                        </tr>
                        <tr>
                            <th>Número</th>
                            <td>{{ $address->number }}</td>
                        </tr>
                        @isset($address->complement)
                            <tr>
                                <th class="w-32">Complemento</th>
                                <td>{{ $address->complement }}</td>
                            </tr>
                        @endisset
                        <tr>
                            <th>Bairro</th>
                            <td>{{ $address->locality }}</td>
                        </tr>
                        <tr>
                            <th>Cidade</th>
                            <td>{{ $address->city }}</td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td>{{ $address->region_code }}</td>
                        </tr>
                        <tr>
                            <th>CEP</th>
                            <td>{{ $address->postal_code }}</td>
                        </tr>
                    </table>
                    <x-button-secondary class="self-end w-fit"
                                        href="{{ route('profile.shipping-address.edit', $address->id) }}">
                        Editar
                        <i class="ml-2 fa-solid fa-pen-to-square"></i>
                    </x-button-secondary>
                </section>
            @endforeach
        @endif
    </div>
</x-app-layout>
