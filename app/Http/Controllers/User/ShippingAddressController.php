<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAddressRequest;
use App\Models\Commission;
use App\Models\ShippingAddress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ShippingAddressController extends Controller
{
    public function index(Request $request): View
    {
        return view('profile.shipping-addresses.index', [
            'addresses' => $request->user()->shippingAddresses()->orderBy('is_default', 'desc')->get(),
        ]);
    }

    public function create(): View
    {
        return view('profile.shipping-addresses.create');
    }

    public function store(ShippingAddressRequest $request): RedirectResponse
    {
        $addresses = $request->user()->shippingAddresses()->get();

        if($addresses->isEmpty()) {
            $default = true;
        } else {
            $default = false;
        }

        ShippingAddress::create([
            'street' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'locality' => $request->locality,
            'city' => $request->city,
            'region_code' => $request->region_code,
            'postal_code' => $request->postal_code,
            'is_default' => $default,
            'user_id' => $request->user()->id,
        ]);

        return redirect(route('profile.shipping-addresses.index'));
    }

    public function edit(Request $request, $id): View
    {
        try {
            $address = $request->user()->shippingAddresses()->get()
                ->where('id', $id)->firstOrFail();

        } catch(\Exception $e) {
            return view('errors.404');
        }

        return view('profile.shipping-addresses.edit', [
            'address' => $address,
        ]);
    }

    public function update(ShippingAddress $shippingAddress, Request $request): RedirectResponse
    {
        $addresses = $request->user()->shippingAddresses()->get();

        // trocar o antigo padrão para falso e atualizar o atual para true

        if($request->has('is_default')) { // se o checkbox estiver marcado
            $oldDefaultShippingAddress = $addresses->where('is_default', true)->first();

            if ($oldDefaultShippingAddress) {
                $oldDefaultShippingAddress->update(['is_default' => false]);
            }
            $shippingAddress->is_default = true;

        } else { // se o checkbox não estiver marcado
            $shippingAddress->is_default = false;
        }

        $shippingAddress->fill($request->validate([
            'street' => ['required', 'string', 'max:160'],
            'number' => ['required', 'string', 'max:20'],
            'complement' => ['max:40'],
            'locality' => ['required', 'string', 'max:60'],
            'city' => ['required', 'string', 'max:90'],
            'region_code' => ['required', 'string', 'max:2'],
            'postal_code' => ['required'],
        ]));

        $shippingAddress->postal_code = str_replace(' ', '', $request->postal_code);

        $shippingAddress->save();

        return redirect(route('profile.shipping-addresses.index'))->with([
            'status' => 'Endereço atualizado com sucesso',
        ]);
    }

    public function destroy(ShippingAddress $shippingAddress, Request $request): RedirectResponse
    {
        $commission = Commission::where('shipping_address_id', $shippingAddress->id)->first();

        if($commission) { // se o endereço estiver em uma encomenda

            $route = route('profile.shipping-addresses.index');
            $message = "Não foi possível excluir este endereço de e-mail porque ele está em um pedido em andamento";
            $type = "danger";
        } else { // se o endereço não estiver em uma encomenda

            $shippingAddress->delete();

            if($shippingAddress->is_default) {
                // se o endereço deletado for padrão, tornar padrão o outro primeiro que aparecer

                $otherShippingAddress = ShippingAddress::where('user_id', $request->user()->id)->first();

                if($otherShippingAddress) {
                    $otherShippingAddress->is_default = true;
                    $otherShippingAddress->save();
                }
            }

            $route = route('profile.shipping-addresses.index');
            $message = "Endereço excluído com sucesso";
            $type = "success";
        }

        return redirect($route)->with([
            'status' => $message,
            'type' => $type,
        ]);
    }
}
