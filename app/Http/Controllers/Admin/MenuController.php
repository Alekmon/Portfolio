<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StoreRequest;
use App\Http\Requests\Admin\Menu\UpdateRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $menus = Menu::all();

        return view('Admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('Admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function() use ($validated, $request){
            $validated['image'] = $request->file('image')->store('public/menus');
    
            $menu = Menu::create($validated);
    
            if($request->has('categories')){
                $menu->categories()->attach($request->categories);
            }

        });
        
        return redirect()->route('admin.menus.index')->with('message', 'Меню успешно создано!');
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
    public function edit(Menu $menu): View
    {
        $categories = Category::all();

        return view('Admin.menu.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function() use ($request, $validated, $menu){
            
            if($request->hasFile('image')){
                Storage::delete($menu->image);
                $validated['image'] = $request->file('image')->store('public/menus');
            }

            $menu->update($validated);

            if($request->has('categories')){
                $menu->categories()->sync($request->categories);
            }
        });

        return redirect()->route('admin.menus.index')->with('message', 'Меню успешно изменено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        DB::transaction(function() use ($menu){
            Storage::delete($menu->image);
            $menu->categories()->detach();
            $menu->delete();
        });

        return redirect()->route('admin.menus.index')->with('message', 'Меню успешно удалено!');
    }
}
