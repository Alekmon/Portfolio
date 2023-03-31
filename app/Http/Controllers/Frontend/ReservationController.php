<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use App\Enums\TableStatus;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ReservationRequest;
use App\Jobs\ReservationJob;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $minDate = Carbon::today();
        $maxDate = Carbon::now()->addWeek();
        return view('Frontend.reservation.step-one', compact('reservation', 'minDate', 'maxDate'));
    }

    public function storeStepOne(ReservationRequest $request)
    {
        $validated = $request->validated();

        if(empty($request->session()->get('reservation'))){
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        return redirect()->route('reservation.two');
    }

    public function stepTwo(Request $request)
    {
        $reservation = $request->session()->get('reservation');

        $tables = Table::where('status', 'available')->where('guest_number', '>=', $reservation->guest_number)->get();
        
        return view('Frontend.reservation.step-two', compact('reservation', 'tables'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required',
        ]);

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

        return redirect()->route('reservation.thanks');
    }
}
