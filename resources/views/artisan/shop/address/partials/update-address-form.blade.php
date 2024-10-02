<x-slot name="heading">
    Editar Endereço
</x-slot>

<x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('shop.address.edit') }}
</x-slot>

<x-form action="{{ route('artisan.shop.address.update') }}">
    @csrf
    @method('patch')

    <div x-data>
        <x-input-label for="postal_code" :value="'CEP'" />
        <x-input-text class="mt-1 block w-full"
                      id="postal_code"
                      name="postal_code"
                      type="text"
                      :value="old('postal_code', $shop->postal_code)"
                      required autofocus autocomplete="postal_code"
                      x-mask="99999-999" placeholder="99999-999"
        />
        <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
    </div>

    <div class="flex">
        <div class="w-full">
            <x-input-label for="street" :value="'Rua'" />
            <x-input-text class="mt-1 block w-full"
                          id="street"
                          name="street"
                          type="text"
                          :value="old('street', $shop->street)"
                          required autofocus autocomplete="street"
            />
            <x-input-error class="mt-2" :messages="$errors->get('street')" />
        </div>

        <div class="ml-4">
            <x-input-label for="number" :value="'Número'" />
            <x-input-text class="mt-1 block w-full"
                          id="number"
                          name="number"
                          type="number"
                          :value="old('number', $shop->number)"
                          required autofocus autocomplete="number"
            />
            <x-input-error class="mt-2" :messages="$errors->get('number')" />
        </div>
    </div>

    <div>
        <x-input-label for="complement" :value="'Complemento'" />
        <x-input-text class="mt-1 block w-full"
                      id="complement"
                      name="complement"
                      type="text"
                      :value="old('complement', $shop->complement)"
                      autofocus autocomplete="complement"
        />
        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
    </div>

    <div>
        <x-input-label for="locality" :value="'Bairro'" />
        <x-input-text class="mt-1 block w-full"
                      id="locality"
                      name="locality"
                      type="text"
                      :value="old('locality', $shop->locality)"
                      required autofocus autocomplete="locality"
        />
        <x-input-error class="mt-2" :messages="$errors->get('locality')" />
    </div>

    <div>
        <x-input-label for="city" :value="'Cidade'" />
        <x-input-text class="mt-1 block w-full"
                      id="city"
                      name="city"
                      type="text"
                      :value="old('city', $shop->city)"
                      required autofocus autocomplete="city"
        />
        <x-input-error class="mt-2" :messages="$errors->get('city')" />
    </div>

    <div>
        <x-input-label for="region_code" :value="'Estado'" />
        <x-input-text class="mt-1 block w-full"
                      id="region_code"
                      name="region_code"
                      type="text"
                      :value="old('region_code', $shop->region_code)"
                      required autofocus autocomplete="region_code"
        />
        <x-input-error class="mt-2" :messages="$errors->get('region_code')" />
    </div>
    <div class="flex gap-8">
        <x-button class="w-full">
            Salvar
        </x-button>
    </div>
</x-form>

@include('artisan.shop.address.partials.delete-address-form')
