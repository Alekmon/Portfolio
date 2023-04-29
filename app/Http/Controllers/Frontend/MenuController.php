<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::paginate(8);
        return view('Frontend.menus.index', compact('menus'));
    }
}
