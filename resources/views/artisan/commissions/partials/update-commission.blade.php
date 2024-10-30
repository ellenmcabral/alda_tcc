<x-button-secondary class="w-full sm:w-fit cursor-pointer"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-commission-update')">
    Alterar Status <i class="fa-solid fa-edit"></i>
</x-button-secondary>

<x-modal :maxWidth="'sm'" name="confirm-commission-update" focusable>
    <form method="post"
          action="{{ route('artisan.commissions.update', $commission->id) }}"
          class="grid gap-4 p-6">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Alterar Status da Encomenda
        </h2>

        <div>
            <x-input-label for="statuses" :value="'Status'"/>
            <x-input-select id="statuses"
                            name="status_id"
                            class="block mt-1 w-full">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}"
                            @if($commission->status->id == $status->id) selected @endif>
                        {{ $status->description }}
                    </option>
                @endforeach
            </x-input-select>
        </div>

        <div class="mt-6 flex justify-end">
            <x-button-outlined :color="'gray'" class="cursor-pointer" x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-button-outlined>

            <x-button class="ms-3">
                SALVAR
            </x-button>
        </div>
    </form>
</x-modal>
