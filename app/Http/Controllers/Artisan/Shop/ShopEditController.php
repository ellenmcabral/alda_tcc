<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function updateInformation(ShopUpdateRequest $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

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
