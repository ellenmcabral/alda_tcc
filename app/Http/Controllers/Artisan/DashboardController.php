<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('artisan.index')->with([
            'shop' => $request->user()->shop,
            'commissions' => $request->user()->shop->commissions()->orderBy('id', 'desc')->paginate(2),
        ]);
    }
}
