<?php

namespace App\Http\Controllers\Commission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommissionListController extends Controller
{
    public function index(Request $request): View
    {
        return view('commissions.index', [
            'commissions' => $request->user()->commissions()
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }
}
