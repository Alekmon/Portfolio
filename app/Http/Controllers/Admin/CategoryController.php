<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('Admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['image'] = $request->file('image')->store('public/categories');
        
        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('message', 'Категория успешно создана!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $validated = $request->validated();
        $validated['image'] = $category->image;

        if($request->hasFile('image')){
            Storage::delete($category->image);
            $validated['image'] = $request->file('image')->store('public/categories');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('message', 'Категория успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::transaction(function() use ($category) {
            Storage::delete($category->image);
            $category->menus()->detach();
            $category->delete();
        });


        return redirect()->route('admin.categories.index')->with('message', 'Категория успешно удалена!');
    }
}
