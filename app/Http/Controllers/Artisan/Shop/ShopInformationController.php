<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ShopInformationController extends Controller
{
    public function edit(Request $request): View
    {
        return view('artisan.shop.information', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->fill($request->validate([
            'name' => ['required', 'string', 'max:150'],
            'url' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique(Shop::class)->ignore($request->user()->shop->id)],
        ]));

        $shop->save();

        return redirect(route('artisan.shop.information'))
            ->with('status', 'profile-updated');
    }
}
