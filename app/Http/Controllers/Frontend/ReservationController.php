<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ReservationRequest;
use App\Service\Reservation\FrontendReservationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReservationController extends Controller
{
    public function stepOne(Request $request): View
    {
        $reservation = $request->session()->get('reservation');
        $minDate = Carbon::today();
        $maxDate = Carbon::now()->addWeek();
        return view('Frontend.reservation.step-one', compact('reservation', 'minDate', 'maxDate'));
    }

    public function storeStepOne(ReservationRequest $request, FrontendReservationService $frontendReservationService): RedirectResponse
    {
        $validated = $request->validated();

        $frontendReservationService->storeStepOne($request, $validated);

        return redirect()->route('reservation.two');
    }

    public function stepTwo(Request $request): View
    {
        $reservation = $request->session()->get('reservation');

        $tables = Table::where('status', 'available')->where('guest_number', '>=', $reservation->guest_number)->get();
        
        return view('Frontend.reservation.step-two', compact('reservation', 'tables'));
    }

    public function storeStepTwo(Request $request, FrontendReservationService $frontendReservationService): RedirectResponse
    {
        $validated = $request->validate([
            'table_id' => 'required',
        ]);

        $frontendReservationService->storeStepTwo($request, $validated);

        return redirect()->route('reservation.thanks');
    }
}
