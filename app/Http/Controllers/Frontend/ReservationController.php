<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use App\Models\Reservation;
use App\Jobs\ReservationJob;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\ReservationRequest;
use App\Enums\TableStatus;

class ReservationController extends Controller
{
    public function stepOne(Request $request): View
    {
        $reservation = $request->session()->get('reservation');
        $minDate = Carbon::today();
        $maxDate = Carbon::now()->addWeek();
        
        return view('Frontend.reservation.step-one', compact('reservation', 'minDate', 'maxDate'));
    }

    public function storeStepOne(ReservationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if(empty($request->session()->get('reservation'))) {
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

    public function stepTwo(Request $request): View
    {
        $reservation = $request->session()->get('reservation');

        $tables = Table::where('status', 'available')->where('guest_number', '>=', $reservation->guest_number)->get();
        
        return view('Frontend.reservation.step-two', compact('reservation', 'tables'));
    }

    public function storeStepTwo(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'table_id' => 'required',
        ]);

        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();

        ReservationJob::dispatch($reservation);

        $table = Table::findOrFail($request->table_id);
        $table->status = TableStatus::Рассматривается;
        $table->save();


        $request->session()->forget('reservation');

        return redirect()->route('reservation.thanks');
    }
}
