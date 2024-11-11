<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopAddressController extends Controller
{
    public function create(Request $request): View
    {
        return view('artisan.shop.address.create', [
            'shop' => $request->user()->shop,
        ]);
    }
    public function edit(Request $request): View
    {
        if($request->user()->shop->street) {

        }

        return view('artisan.shop.address.edit', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->fill($request->validate([
            'street' => ['required', 'string', 'max:160'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['max:40'],
            'locality' => ['required', 'string', 'max:60'],
            'city' => ['required', 'string', 'max:90'],
            'region_code' => ['required', 'string', 'max:2'],
            'postal_code' => ['required'],
        ]));

        $shop->save();

        return redirect(route('artisan.shop.address.edit'))
            ->with([
                'status' => 'Endereço atualizado!'
            ]);
    }

    public function remove(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->fill([
            'street' => null,
            'number' => null,
            'complement' => null,
            'locality' => null,
            'city' => null,
            'region_code' => null,
            'postal_code' => null,
        ]);

        $shop->save();

        return redirect(route('artisan.shop.edit'))
            ->with([
                'status' => 'Endereço excluído!'
            ]);
    }
}
