<x-dashboard-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('users.edit', $user->name) }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form :action="route('admin.users.update', $user->id)">
            @method('patch')

            <div>
                <x-input-label for="name" :value="'Nome'" />
                <x-input-text id="name"
                              name="name"
                              type="name"
                              :value="old('name', $user->name)"
                              placeholder="Nome do usuário"
                              autocomplete autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="'E-mail'" />
                <x-input-text id="email"
                              name="email"
                              type="email"
                              :value="old('email', $user->email)"
                              placeholder="E-mail do usuário"
                              autocomplete />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div x-data>
                <x-input-label for="phone" :value="'Telefone'" />
                <x-input-text id="phone"
                              name="phone"
                              type="phone"
                              :value="old('phone', $user->phone)"
                              x-mask="(99) 9 9999-9999"
                              placeholder="(00) 0 0000-0000"
                              required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-dashboard-layout>
