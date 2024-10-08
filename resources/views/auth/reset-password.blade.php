<x-app-layout>
    <div class="grid gap-8 w-full h-fit md:w-1/2 xl:w-1/3">
        <x-text-heading>
            Modificar Senha
        </x-text-heading>

        <x-form :width="'full'"
                action="{{ route('password.store') }}">
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="'E-mail'" />
                <x-input-text id="email"
                              class="w-full"
                              type="email"
                              name="email"
                              :value="old('email', $request->email)"
                              placeholder="Digite o seu e-mail"
                              required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-input-text id="password"
                              class="w-full"
                              type="password"
                              name="password"
                              required autocomplete="new-password"
                              placeholder="Digite a sua nova senha" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input-text id="password_confirmation"
                              class="w-full"
                              type="password"
                              name="password_confirmation"
                              required autocomplete="new-password"
                              placeholder="Digite a sua nova senha novamente" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-button>
                Salvar
            </x-button>
        </x-form>
    </div>
</x-app-layout>
