<?php

namespace App\Service\Reservation;

use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use App\Jobs\ReservationJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FrontendReservationService
{

    public function storeStepOne(FormRequest $request, $validated)
    {
        if(empty($request->session()->get('reservation'))){
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }
    }

    public function storeStepTwo(Request $request, $validated)
    {
        DB::transaction(function() use ($validated, $request){
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $reservation->save();
            
            ReservationJob::dispatch($reservation);

            $table = Table::findOrFail($request->table_id);
            $table->status = TableStatus::Рассматривается;
            $table->save();


            $request->session()->forget('reservation');
        });
    }

}