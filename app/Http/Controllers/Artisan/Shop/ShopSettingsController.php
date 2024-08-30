<?php

namespace App\Http\Controllers\Artisan\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopSettingsController extends Controller
{
    /**
     * Display the user's shop form.
     */
    public function settings(Request $request): View
    {
        return view('artisan.shop.settings', [
            'shop' => $request->user()->shop,
        ]);
    }

    /**
     * Delete the user's shop.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('shopDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $request->user()->shop->delete();

        $request->user()->syncRoles('user');

        $request->user()->givePermissionTo('create shop');

        return redirect(route('home'));
    }
}
