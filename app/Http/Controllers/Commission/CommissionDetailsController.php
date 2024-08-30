<?php

namespace App\Http\Controllers\Commission;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommissionDetailsController extends Controller
{
    public function show(Commission $commission, Request $request): View
    {
        return view('commissions.show', [
            'commission' => $request->user()->commissions()->findOrFail($commission->id),
            'commissionProducts' => $commission->commissionProducts()->get(),
        ]);
    }
}
