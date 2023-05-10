<?php

namespace App\Service\Reservation;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class AdminReservationService
{
    public function storeReservation(FormRequest $request, $validated): void
    {
        $table = Table::findOrFail($request->table_id);

        Reservation::create($validated);
        $table->status = TableStatus::Рассматривается;
        $table->save();
    }

    public function updateReservation(FormRequest $request, Reservation $reservation, $validated): void
    {
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
    }

    public function destroyReservation(Reservation $reservation): void
    {
        DB::transaction(function() use ($reservation) {
            $table = Table::findOrFail($reservation->table_id);
            $table->status = TableStatus::Доступно;
            $table->save();
            $reservation->delete();
        });
    }
}