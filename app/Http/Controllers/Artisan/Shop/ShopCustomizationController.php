<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopCustomizationController extends Controller
{
    public function edit(Request $request): View
    {
        return view('artisan.shop.customization', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        //

        return redirect(route('artisan.shop.customization'));
    }
}
