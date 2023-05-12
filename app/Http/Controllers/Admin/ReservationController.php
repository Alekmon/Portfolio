<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Reservation\StoreRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reservations = Reservation::all();
        return view('Admin.reservation.index' ,compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tables = Table::where('status', 'available')->get();
        return view('Admin.reservation.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $table = Table::findOrFail($request->table_id);

        Reservation::create($validated);
        $table->status = TableStatus::Рассматривается;
        $table->save();
        
        return redirect()->route('admin.reservation.index')->with('message', 'Бронь успешно создана!');
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
    public function edit(Reservation $reservation): View
    {
        $tables = Table::where('status', 'available')->get();
        return view('Admin.reservation.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Reservation $reservation): RedirectResponse
    {
        $validated = $request->validated();
        
        //если поменяли столик, изменяем статус
        if($request->get('table_id') != $reservation->table_id){
            $oldTable = Table::findOrFail($reservation->table_id);
            $newTable = Table::findOrFail($request->table_id);
            $oldTable->status = TableStatus::Доступно;
            $oldTable->save();
            $newTable->status = TableStatus::Недоступно;
            $newTable->save();
        }
        
        $reservation->update($validated);

        return redirect()->route('admin.reservation.index')->with('message', 'Бронь успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {

        DB::transaction(function() use ($reservation) {
            $table = Table::findOrFail($reservation->table_id);
            $table->status = TableStatus::Доступно;
            $table->save();
            $reservation->delete();
        });

        return redirect()->route('admin.reservation.index')->with('message', 'Бронирование успешно удаленно!');
    }
}
