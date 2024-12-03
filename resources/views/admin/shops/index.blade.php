<x-dashboard-layout>
    <x-slot:heading>
        Lojas
    </x-slot:heading>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <section>
            <livewire:admin-search :searchType="'shops'" />
        </section>
    </div>
</x-dashboard-layout>

