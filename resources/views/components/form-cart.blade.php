<form class="w-full flex items-end gap-4" method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden"
           name="shop_id"
           value="{{ $product->shop_id }}" />

    <input type="hidden"
           name="id"
           value="{{ $product->id }}" />

    <input type="hidden"
           name="name"
           value="{{ $product->name }}" />

    <input type="hidden"
           name="sale_price"
           value="{{ $product->sale_price }}" />

    <input type="hidden"
           name="image"
           value="{{ $product->image }}" />

    @isset($quantity)
        <div>
            <h3 class="font-bold text-lg">
                Quantidade
            </h3>
            <input type="number"
                   id="quantity"
                   name="quantity"
                   value="1"
                   class="w-full mt-1 h-10 rounded-lg focus:ring-0 focus:border-gray-400 border-gray-400 focus:text-primary-700"
                   required />
        </div>
    @else
        <x-input-text type="hidden"
                      name="quantity"
                      value="1" />
    @endisset

    <x-button class="w-full items-center h-10">
        Comprar
    </x-button>
</form>
