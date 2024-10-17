<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ShopEditController extends Controller
{
    public function edit(Request $request): View
    {
        return view('artisan.shop.edit', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function information(Request $request): View
    {
        return view('artisan.shop.information', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function updateInformation(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->fill($request->validate([
            'name' => ['required', 'string', 'min:3', 'max:60'],
            'url' => ['required', 'string', 'min:3', 'max:60', 'alpha_dash', Rule::unique(Shop::class)->ignore($request->user()->shop->id)],
        ]));

        $shop->save();

        return redirect(route('artisan.shop.information'))
            ->with('status', 'Loja atualizada com sucesso!');
    }

    public function customization(Request $request): View
    {
        return view('artisan.shop.customization', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function updateCustomization(Request $request): RedirectResponse
    {
        //

        return redirect(route('artisan.shop.customization'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('shopDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $request->user()->shop->delete();

        $request->user()->syncRoles('user');

        $request->user()->givePermissionTo('create shop');

        return redirect(route('home'));
    }
}
