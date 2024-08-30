<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request): View
    {
        try {
            $items = \Cart::content();

            $shippingAddresses = $request->user()->shippingAddresses()
                ->orderBy('is_default', 'desc')
                ->get();

            $total = (float) str_replace(',', '', \Cart::total());

            $cart_total = $total - \Cart::tax();

            foreach($items as $item) { //encontrar a loja dona do item na sacola
                $product = Product::findOrFail($item->id);

                break;
            }

            $shop = Shop::findOrFail($product->shop_id);
        } catch (\Exception $e) {
            return view('errors.404');
        }

        return view('checkout.index', [
            'user' => $request->user(),
            'items' => $items,
            'shippingAddresses' => $shippingAddresses,
            'shop' => $shop,
            'cart_total' => $cart_total,
        ]);
    }
}
