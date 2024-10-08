<x-modal :maxWidth="'sm'"
         name="{{ $name }}"
         :show="$errors->$show->isNotEmpty()" focusable>
    <form class="grid gap-4 p-6"
          method="post"
          action="{{ $action }}">
        @csrf
        @method('delete')

        <h3 class="text-2xl font-bold text-neutral-black">
            {{ $heading }}
        </h3>

        @isset($description)
            <p class="text-gray-dark">
                {{ $description }}
            </p>
        @endisset

        @if($password)
            <x-input-text
                id="password"
                name="password"
                type="password"
                class="w-full"
                placeholder="Digite sua senha para confirmar" />

            <x-input-error :messages="$errors->shopDeletion->get('password')" />
        @endif

        <div class="flex gap-4">
            <x-button-outlined :color="'gray'"
                               class="cursor-pointer w-full"
                               x-on:click="$dispatch('close')">
                Cancelar
            </x-button-outlined>

            <x-button-danger class="w-full">
                EXCLUIR
            </x-button-danger>
        </div>
    </form>
</x-modal>
