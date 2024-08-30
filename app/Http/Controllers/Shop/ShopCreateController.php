<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShopCreateController extends Controller
{
    public function create(Request $request)
    {
        return view('shop.create',[
            'user' => $request->user()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'url' => ['required', 'string', 'min:3', 'max:50', 'unique:'.Shop::class, 'alpha_dash'],
        ]);

        Shop::create([
            'name' => $request->name,
            'url' => $request->url,
            'user_id' => auth()->id(),
        ]);

        $request->user()->revokePermissionTo(['create shop']);
        $request->user()->givePermissionTo(['activate shop']);

        return redirect(route('home'));
    }
}
