<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\CommissionProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommissionController extends Controller
{
    public function index(Request $request): View
    {
        return view('commissions.index', [
            'commissions' => $request->user()->commissions()->orderBy('created_at', 'desc')->get(),
        ]);
    }

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
            ->with('status', 'Encomenda realizada. Faça o pagamento para que o artesão possa começar a produzir');
    }

    public function show(Commission $commission, Request $request): View
    {
        return view('commissions.show', [
            'commission' => $request->user()->commissions()->findOrFail($commission->id),
            'commissionProducts' => $commission->commissionProducts()->get(),
        ]);
    }

    public function destroy(Commission $commission, Request $request): RedirectResponse
    {
        $request->validateWithBag('commissionDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $commission->delete();

        return redirect(route('commissions.index'))
            ->with('status', 'Encomenda cancelada');
    }
}
