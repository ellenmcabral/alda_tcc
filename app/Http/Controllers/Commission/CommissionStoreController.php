<?php

namespace App\Http\Controllers\Commission;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommissionStoreController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $commission = Commission::create([
            'total' => $request->total,
            'payment' => $request->payment,
            'user_id' => $request->user()->id,
            'shop_id' => $request->shop_id,
            'shipping_address_id' => $request->address_id,
            'status_id' => 1,
        ]);

        $items = \Cart::content();

        foreach($items as $item) {
            CommissionProduct::create([
                'sale_price' => $item->price,
                'quantity' => $item->qty,
                'total' => $item->price * $item->qty,
                'product_id' => $item->id,
                'commission_id' => $commission->id,
            ]);
        }

//        Mail::to($request->user()->email, $request->user()->name)
//            ->send(new CommissionStored($commission, 'user'));
//
//        Mail::to($commission->shop->user->email, $commission->shop->user->name)
//            ->send(new CommissionStored($commission, 'shop'));
//
//        Mail::to($commission->user->email, $commission->user->name)
//            ->send(new CommissionUpdated($commission));

        \Cart::destroy();

        return redirect(route('commissions.index'))
            ->with('status', 'Encomenda realizada. Faça o pagamento para que o artesão possa começar a produzir.');
    }
}
