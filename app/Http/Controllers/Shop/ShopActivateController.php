<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShopActivateController extends Controller
{
    public function activate(Request $request)
    {
        return view('shop.activate-form', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        if($request->option == 'cpf') {
            $shop->fill($request->validate([
                'cpf' => ['required', 'string', 'min:14'],
            ]));

            $shop->cpf = preg_replace('/[^0-9]/','', $request->cpf);
        }

        if($request->option == 'cnpj') {
            $shop->fill($request->validate([
                'cnpj' => ['required', 'string', 'min:18'],
            ]));

            $shop->cnpj = preg_replace('/[^0-9]/','', $request->cnpj);

        }
        $shop->is_active = true;

        $shop->save();

        $request->user()->revokePermissionTo(['activate shop']);

        $request->user()->syncRoles('artisan');

        return redirect(route('artisan.index'));
    }
}
