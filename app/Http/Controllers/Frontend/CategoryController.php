<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Frontend.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('Frontend.categories.show', compact('category'));
    }
}
