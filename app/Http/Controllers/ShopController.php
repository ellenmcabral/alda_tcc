<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shop\ShopActivateRequest;
use App\Http\Requests\Shop\ShopStoreRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function create()
    {
        return view('shop.create');
    }

    public function store(ShopStoreRequest $request): RedirectResponse
    {
        Shop::create([
            'name' => $request->name,
            'url' => $request->url,
            'image' => 'no-image.jpg',
            'user_id' => auth()->id(),
        ]);

        $request->user()->revokePermissionTo(['create shop']);

        $request->user()->givePermissionTo(['activate shop']);

        return redirect(route('home'));
    }

    public function show($url): View
    {
        $shop = Shop::where('url', $url)->firstOrFail();
        $products = $shop->products()->get();

        return view('shop.show', [
            'shop' => $shop,
            'products' => $products,
        ]);
    }

    public function activate(Request $request)
    {
        return view('shop.activate', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(ShopActivateRequest $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        if($request->option == 'cpf') {
            $request->user()->cpf = preg_replace('/[^0-9]/','', $request->cpf);

            $request->user()->save();
        }

        if($request->option == 'cnpj') {
            $shop->cnpj = preg_replace('/[^0-9]/','', $request->cnpj);
        }
        $shop->is_active = true;

        $shop->save();

        $request->user()->revokePermissionTo(['activate shop']);

        $request->user()->syncRoles('artisan');

        return redirect(route('artisan.index'));
    }
}
