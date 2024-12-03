<x-dashboard-layout>
    <x-slot:heading>
        Permissões
    </x-slot:heading>

    <div class="w-full h-fit grid gap-8 md:w-2/3">
        <section>
            <x-button-secondary href="{{ route('admin.permissions.create') }}"
                                class="w-fit"
                                :color="'secondary'">
                Adicionar
                <i class="text-sm fa-solid fa-plus"></i>
            </x-button-secondary>
        </section>
        <section>
            <ul class="grid gap-4">
                @foreach($permissions as $permission)
                    <li class="flex justify-between border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-regular py-4">
                        {{ $permission->name }}

                        <div class="flex gap-4 text-gray-regular">
                            <a href=""><i class="fa-solid fa-trash"></i></a>
                            <a href=""><i class="fa-solid fa-pen-to-square"></i></a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</x-dashboard-layout>
