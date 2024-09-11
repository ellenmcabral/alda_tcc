<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $items = Cart::content();

        if($items->isNotEmpty()) {
            foreach($items as $item) {
                $product = Product::find($item->id);
                $url = view('cart', compact('items'), ['shop' => $product->shop]);
                break;
            }
        }
        else {
            $url = view('cart', compact('items'));
        }

        return $url;
    }

    public function add(Request $request): RedirectResponse
    {
        $items = Cart::content();

        $product = Product::where('id', $request->id)->first();

        if($items->isNotEmpty()) { // A SACOLA POSSUI ITENS
            foreach ($items as $item) {
                $cartItem = Product::where('id', $item->id)->first();

                if ($cartItem->shop_id != $product->shop_id) {
                    // COMPARA A LOJA DO ITEM DO CARRINHO COM O PRODUTO SENDO ADICIONADO
                    // SE FOR DE LOJAS DIFERENTES, REDIRECIONA PARA A MSM PAGINA COM A MENSAGEM DE ERRO

                    $route = route('products.show', $product->url);
                    $valid = false;
                }
                else {
                    $valid = true;
                    $route = route('cart');
                }
                break;
            }
        }
        else { // A SACOLA ESTA VAZIA
            $valid = true;
            $route = route('cart');
        }

        if($valid) {
            $shop = Shop::where('id', $product->shop_id)->first();

            \Cart::add([
                'id' => $request->id,
                'name' => $request->name,
                'qty' => $request->quantity,
                'price' => $request->sale_price,
                'weight' => 0,
                'options' => [
                    'image' => $request->image,
                ],
            ]);
            $status = 'product-added';
        }
        else {
            $shop = '';
            $status = 'product-not-added';
        }

        return redirect($route)
            ->with('status', $status)
            ->with('shop', $shop);
    }

    public function update(Request $request, $rowId): RedirectResponse
    {
        if($request->increment) {
            $newQty = $request->quantity + 1;
        } else {
            $newQty = $request->quantity - 1;
        }

        Cart::update($rowId, $newQty);

        return redirect(route('cart'));
    }

    public function delete($rowId): RedirectResponse
    {
        Cart::remove($rowId);

        return redirect(route('cart'));
    }

    public function destroy(): RedirectResponse
    {
        Cart::destroy();

        return redirect(route('cart'));
    }

}
