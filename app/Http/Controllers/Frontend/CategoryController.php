<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->paginate(12);
        return view('Frontend.categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        return view('Frontend.categories.show', compact('category'));
    }
}
