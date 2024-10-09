<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\View\View;

class ShopShowController extends Controller
{
    public function show($url): View
    {
        $shop = Shop::where('url', $url)->firstOrFail();

        return view('shop.show', [
            'shop' => $shop,
            'products' => $shop->products()->paginate(10),
        ]);
    }
}
