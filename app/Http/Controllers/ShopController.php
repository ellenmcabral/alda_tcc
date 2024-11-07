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
        $user = $request->user();

        $shop = $user->shop;

        if($request->option == 'cpf') {
            $user->cpf = preg_replace('/[^0-9]/','', $request->cpf);
        }

        if($request->option == 'cnpj') {
            $user->cnpj = preg_replace('/[^0-9]/','', $request->cnpj);
        }

        $user->save();

        $shop->is_active = true;

        $shop->save();

        $user->revokePermissionTo(['activate shop']);

        $user->syncRoles('artisan');

        return redirect(route('artisan.index'))
            ->with('status', 'Loja ativada com sucesso');
    }
}
