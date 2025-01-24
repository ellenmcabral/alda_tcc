<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\ShopUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ShopEditController extends Controller
{
    public function edit(Request $request): View
    {
        return view('artisan.shop.edit', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function information(Request $request): View
    {
        return view('artisan.shop.information', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function updateInformation(ShopUpdateRequest $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $shop->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return redirect(route('artisan.shop.information'))
            ->with('status', 'Informações da loja atualizadas!');
    }

    public function customization(Request $request): View
    {
        return view('artisan.shop.customization', [
            'shop' => $request->user()->shop,
        ]);
    }

    public function updateCustomization(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        if($request->hasFile('image')) {
            $image = $request->image;

            $imageName = md5($image->getClientOriginalName()
                    . strtotime("now")) . "." . $image->extension();

            //$image->move(public_path('img/shops'), $imageName);
            Storage::disk('s3')->put("img/shops/". $imageName, file_get_contents($image),
                'public');

            $shop->image = $imageName;
        }

        if($request->description) {
            $shop->description = $request->description;
        } else {
            $shop->description = null;
        }

        $shop->save();

        return redirect(route('artisan.shop.customization'))
            ->with('status', 'Personalização da loja atualizada!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $shop = $request->user()->shop;

        $request->validateWithBag('shopDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        File::delete(public_path('img/shops') . '/' . $shop->image);

        $shop->delete();

        $request->user()->syncRoles('user');

        $request->user()->givePermissionTo('create shop');

        return redirect(route('home'))
            ->with('status', 'Loja excluída!');
    }
}
