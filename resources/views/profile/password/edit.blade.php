<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('profile.password.edit') }}
    </x-slot:breadcrumbs>

    <div class="grid gap-8 w-full h-fit md:w-2/3">
        <x-form action="{{ route('password.update') }}">
            @method('put')
            <div>
                <x-input-label for="update_password_current_password" :value="'Senha Atual'" />
                <x-input-text id="update_password_current_password"
                              name="current_password"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua senha atual"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="'Nova Senha'" />
                <x-input-text id="update_password_password"
                              name="password"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua nova senha"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="'Confirmar Senha'" />
                <x-input-text id="update_password_password_confirmation"
                              name="password_confirmation"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua senha novamente"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <x-slot:cancelButton>
                <x-button-outlined href="{{ route('profile.show') }}"
                                   class="w-full" :color="'gray'">
                    Cancelar
                </x-button-outlined>
            </x-slot:cancelButton>

            <x-slot:button>
                Salvar
            </x-slot:button>

            <!-- @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600"
                >Senha salva.</p>
            @endif -->
        </x-form>
    </div>
</x-app-layout>
