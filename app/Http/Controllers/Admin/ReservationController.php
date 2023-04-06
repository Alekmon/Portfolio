<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reservation\StoreRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Service\Reservation\AdminReservationService;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('Admin.reservation.index' ,compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::where('status', 'available')->get();
        return view('Admin.reservation.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, AdminReservationService $adminReservationService)
    {
        $validated = $request->validated();
        
        $adminReservationService->storeReservation($request, $validated);

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
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', 'available')->get();
        return view('Admin.reservation.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Reservation $reservation, AdminReservationService $adminReservationService)
    {
        $validated = $request->validated();
        
        $adminReservationService->updateReservation($request, $reservation, $validated);

        return redirect()->route('admin.reservation.index')->with('message', 'Бронь успешно изменена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation, AdminReservationService $adminReservationService)
    {

        $adminReservationService->destroyReservation($reservation);

        return redirect()->route('admin.reservation.index')->with('message', 'Бронирование успешно удаленно!');
    }
}
