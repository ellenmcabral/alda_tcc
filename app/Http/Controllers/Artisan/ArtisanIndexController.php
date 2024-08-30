<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtisanIndexController extends Controller
{
    public function index(): View
    {
        return view('artisan.index');
    }
}
