<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $data['categories'] = Category::all()->count();
        $data['menus'] = Menu::all()->count();
        $data['reservations'] = Reservation::all()->count();
        $data['tables'] = Table::all()->count();

        return view('Admin.index', $data);
    }
}
