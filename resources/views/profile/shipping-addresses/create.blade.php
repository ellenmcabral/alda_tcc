<x-app-layout>
    <x-slot:breadcrumbs>
        {{ Breadcrumbs::render('shipping-addresses.create') }}
    </x-slot:breadcrumbs>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <x-form action="{{ route('profile.shipping-addresses.store') }}">

            <livewire:inputs-address :address="null" />

            <x-slot:button>
                Salvar
            </x-slot:button>
        </x-form>
    </div>
</x-app-layout>
