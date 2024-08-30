<?php

namespace App\Http\Controllers\Artisan\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductDeleteController extends Controller
{
    public function destroy(Product $product, Request $request): RedirectResponse
    {
        $request->validateWithBag('productDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        File::delete(public_path('img/products').'/'.$product->image);

        $product->delete();

        return redirect(route('artisan.products.index'));
    }
}
