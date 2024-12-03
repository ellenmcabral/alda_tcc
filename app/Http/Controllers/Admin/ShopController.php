<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Shop\ShopUpdateRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ShopController
{
    public function index(): View
    {
        return view('admin.shops.index', [
            'shops' => Shop::query()->orderBy('id')->paginate(10),
        ]);
    }

    public function edit(Shop $shop): View
    {
        return view('admin.shops.edit', [
            'shop' => $shop,
        ]);
    }

    public function update(Shop $shop, ShopUpdateRequest $request): RedirectResponse
    {
        $shop->update($request->validated());

        if($request->hasFile('image')) {
            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName()
                    . strtotime("now")) . "." . $request->image->extension();

            $requestImage->move(public_path('img/shops'), $imageName);

            $shop->image = $imageName;

            $shop->save();
        }

        return redirect()->route('admin.shops.edit', $shop)
            ->with('status', "Loja '{$shop->name}' atualizada!");
    }

    public function destroy(Shop $shop, Request $request): RedirectResponse
    {
        $request->validateWithBag('shopDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $shop->delete();

        $shop->user->syncRoles('user');

        $shop->user->givePermissionTo('create shop');

        return redirect()->route('admin.shops.index')
            ->with('status', "Loja '{$shop->name}' excluída!");
    }
}
