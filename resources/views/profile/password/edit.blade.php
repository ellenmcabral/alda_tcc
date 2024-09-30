<x-app-layout>
    <div class="grid gap-8 w-full lg:w-1/2 xl:w-1/3">
        <div class="hidden sm:inline-flex">
            {{ Breadcrumbs::render('profile.password.edit') }}
        </div>

        <x-text-heading>
            Editar Senha
        </x-text-heading>

        <x-form action="{{ route('password.update') }}">
            @method('put')
            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <x-input-text id="update_password_current_password"
                              name="current_password"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua senha atual"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <x-input-text id="update_password_password"
                              name="password"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua nova senha"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-input-text id="update_password_password_confirmation"
                              name="password_confirmation"
                              type="password"
                              class="w-full"
                              placeholder="Digite a sua senha novamente"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-button class="w-full">
                    {{ __('Save') }}
                </x-button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }"
                       x-show="show"
                       x-transition
                       x-init="setTimeout(() => show = false, 2000)"
                       class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </x-form>
    </div>
</x-app-layout>
