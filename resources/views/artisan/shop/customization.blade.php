<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shop.customization') }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 w-full h-fit md:w-2/3">
        <x-form action="#" enctype="multipart/form-data">
            <div>
                <x-input-label for="image" :value="'Imagem'" />
                <input id="image"
                       class="w-full mt-2 file:rounded-lg rounded-lg cursor-pointer focus:outline-none"
                       type="file"
                       name="image"
                       :value="old('image')"
                       autofocus
                       autocomplete="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
        <p>
            Foto de perfil
        </p>

        <p>
            Descrição
        </p>
    </div>
</x-dashboard-layout>
