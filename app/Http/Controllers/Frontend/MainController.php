<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MainController extends Controller
{
    public function index()
    {
        $randomMenus = Menu::inRandomOrder()->limit(8)->get();

        return view('main', compact('randomMenus'));
    }
}
