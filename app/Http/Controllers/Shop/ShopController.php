<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function create(Request $request)
    {
        return view('shop.create',[
            'user' => $request->user()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'url' => ['required', 'string', 'min:3', 'max:50', 'unique:'.Shop::class, 'alpha_dash'],
        ]);

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

        return view('shop.show', [
            'shop' => $shop,
            'products' => $shop->products()->paginate(10),
        ]);
    }

    public function activate(Request $request)
    {
        return view('shop.activate', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        if($request->option == 'cpf') {
            $request->user()->fill($request->validate([
                'cpf' => ['required', 'string', 'min:14'],
            ]));

            $request->user()->cpf = preg_replace('/[^0-9]/','', $request->cpf);

            $request->user()->save();
        }

        if($request->option == 'cnpj') {
            $shop->fill($request->validate([
                'cnpj' => ['required', 'string', 'min:18'],
            ]));

            $shop->cnpj = preg_replace('/[^0-9]/','', $request->cnpj);

        }
        $shop->is_active = true;

        $shop->save();

        $request->user()->revokePermissionTo(['activate shop']);

        $request->user()->syncRoles('artisan');

        return redirect(route('artisan.index'));
    }
}
