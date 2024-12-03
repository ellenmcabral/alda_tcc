<div class="grid gap-8">
    <search>
        <div class="w-full flex gap-2 items-center px-4 border bg-white rounded-lg border-gray-regular cursor-pointer focus-within:ring-1 focus-within:border-1 focus-within:border-accent-regular focus-within:ring-accent-regular focus-within:outline-none">
            <label for="search"><i class="text-gray-regular fa-solid fa-search"></i></label>
            <input class="border-none focus:outline-none focus:ring-0 focus:border-none w-full"
                   id="search"
                   type="text"
                   name="search"
                   placeholder="Digite a sua pesquisa..."
                   wire:model.live.debounce.300ms="search" />
        </div>
    </search>

    @if($results->isEmpty())
        <p class="text-gray-dark">
            Nenhum resultado encontrado.
        </p>
    @else
        <ul class="grid gap-8 lg:grid-cols-3">
            @foreach($results as $result)
                <li class="grid gap-4 p-6 shadow-md bg-white lg:rounded-lg">
                    <div>
                        <p class="line-clamp-2">{{ $result->name }}</p>
                        <p class="line-clamp-1 font-bold text-sm text-gray-dark">
                            @if($searchType == 'users')
                                {{ $result->email }}
                            @elseif($searchType == 'shops')
                                {{ $result->formatUrl() }}
                            @endif
                        </p>
                    </div>

                    <div class="flex justify-between">
                        @if($searchType == 'users')
                            <a class="cursor-pointer text-gray-regular text-2xl hover:text-gray-dark transition duration-300"
                               x-data=""
                               x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $result->id }}')">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                            <x-modal-delete name="confirm-user-deletion-{{ $result->id }}"
                                            :show="'userDeletion'"
                                            :action="route('admin.users.destroy', $result->id)"
                                            :password="true">
                                <x-slot:heading>
                                    Tem certeza que quer excluir o usuário '{{ $result->name }}'?
                                </x-slot:heading>
                            </x-modal-delete>
                        @elseif($searchType == 'shops')
                            <a class="cursor-pointer text-gray-regular text-2xl hover:text-gray-dark transition duration-300"
                               x-data=""
                               x-on:click.prevent="$dispatch('open-modal', 'confirm-shop-deletion-{{ $result->id }}')">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                            <x-modal-delete name="confirm-shop-deletion-{{ $result->id }}"
                                            :show="'shopDeletion'"
                                            :action="route('admin.shops.destroy', $result->id)"
                                            :password="true">
                                <x-slot:heading>
                                    Tem certeza que quer excluir a loja '{{ $result->name }}'?
                                </x-slot:heading>
                            </x-modal-delete>
                        @endif

                        <a class="text-2xl text-accent-dark hover:text-accent-darker duration-300 ease-in-out"
                           href="@if($searchType == 'users')
                                {{ route('admin.users.edit', $result->id) }}
                            @elseif($searchType == 'shops')
                                {{ route('admin.shops.edit', $result->id) }}
                             @endif">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    {{ $results->links() }}
</div>
