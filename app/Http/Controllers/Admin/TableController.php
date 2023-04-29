<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Table\StoreRequest;
use App\Http\Requests\Admin\Table\UpdateRequest;
use App\Models\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tables = Table::all();
        return view('Admin.table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('Admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Table::create($validated);

        return redirect()->route('admin.tables.index')->with('message', 'Столик успешно создан!');
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
    public function edit(Table $table): View
    {
        return view('Admin.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Table $table): RedirectResponse
    {
        $validated = $request->validated();

        $table->update($validated);

        return redirect()->route('admin.tables.index')->with('message', 'Столик успешно изменен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table): RedirectResponse
    {
        $table->delete();

        return redirect()->route('admin.tables.index')->with('message', 'Столик успешно удален!');
    }
}
