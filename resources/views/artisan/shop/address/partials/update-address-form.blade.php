<x-slot name="heading">
    Editar Endereço
</x-slot>

<x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('shop.address.edit') }}
</x-slot>

<form class="grid gap-8"
      method="post"
      action="{{ route('artisan.shop.address.update') }}">
    @csrf
    @method('patch')

    <div class="mt-2" x-data>
        <x-input-label for="postal_code" :value="'CEP'" />
        <x-text-input class="mt-1 block w-full"
                      id="postal_code"
                      name="postal_code"
                      type="text"
                      :value="old('postal_code', $shop->postal_code)"
                      required autofocus autocomplete="postal_code"
                      x-mask="99999-999" placeholder="99999-999"
        />
        <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
    </div>

    <div class="flex mt-2">
        <div class="w-full">
            <x-input-label for="street" :value="'Rua'" />
            <x-text-input class="mt-1 block w-full"
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
            <x-text-input class="mt-1 block w-full"
                          id="number"
                          name="number"
                          type="number"
                          :value="old('number', $shop->number)"
                          required autofocus autocomplete="number" />
            <x-input-error class="mt-2" :messages="$errors->get('number')" />
        </div>
    </div>

    <div class="mt-2">
        <x-input-label for="complement" :value="'Complemento'" />
        <x-text-input class="mt-1 block w-full"
                      id="complement"
                      name="complement"
                      type="text"
                      :value="old('complement', $shop->complement)"
                      autofocus autocomplete="complement" />
        <x-input-error class="mt-2" :messages="$errors->get('complement')" />
    </div>

    <div class="mt-2">
        <x-input-label for="locality" :value="'Bairro'" />
        <x-text-input class="mt-1 block w-full"
                      id="locality"
                      name="locality"
                      type="text"
                      :value="old('locality', $shop->locality)"
                      required autofocus autocomplete="locality"
        />
        <x-input-error class="mt-2" :messages="$errors->get('locality')" />
    </div>

    <div class="mt-2">
        <x-input-label for="city" :value="'Cidade'" />
        <x-text-input class="mt-1 block w-full"
                      id="city"
                      name="city"
                      type="text"
                      :value="old('city', $shop->city)"
                      required autofocus autocomplete="city"
        />
        <x-input-error class="mt-2" :messages="$errors->get('city')" />
    </div>

    <div class="mt-2">
        <x-input-label for="region_code" :value="'Estado'" />
        <x-text-input class="mt-1 block w-full"
                      id="region_code"
                      name="region_code"
                      type="text"
                      :value="old('region_code', $shop->region_code)"
                      required autofocus autocomplete="region_code"
        />
        <x-input-error class="mt-2" :messages="$errors->get('region_code')" />
    </div>
    <x-primary-button class="mt-4">
        Salvar
    </x-primary-button>
</form>
