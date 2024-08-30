<?php

namespace App\Http\Controllers\Commission;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommissionDeleteController extends Controller
{
    public function destroy(Commission $commission, Request $request): RedirectResponse
    {
        $request->validateWithBag('commissionDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $commission->delete();

        return redirect(route('commissions.index'))
            ->with('status', 'commission-destroyed');
    }
}
