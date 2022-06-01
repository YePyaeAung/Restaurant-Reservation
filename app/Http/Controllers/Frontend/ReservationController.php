<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }
    public function storeStepOne(Request $request)
    {
        $stepOneValidated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'tel_number' => ['required'],
            'guest_number' => ['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new Reservation();
            $reservation->fill($stepOneValidated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($stepOneValidated);
            $request->session()->put('reservation', $reservation);
        }

        return to_route('reservations.step.two');
    }
    public function stepTwo(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $reservation_tables_ids = Reservation::orderBy('res_date')->get()->filter(function($value) use ($reservation) {
            return date('Y-m-d', strtotime($value->res_date)) == date('Y-m-d', strtotime($reservation->res_date));
        })->pluck('table_id');
        $tables = Table::where('status', TableStatus::Avaliable)->where('guest_number', '>=', $reservation->guest_number)->whereNotIn('id', $reservation_tables_ids)->get();
        return view('reservations.step-two', compact('reservation', 'tables'));
    }
    public function storeStepTwo(Request $request)
    {
        $stepTwoValidated = $request->validate([
            'table_id' => ['required'],
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($stepTwoValidated);
        $reservation->save();
        $request->session()->forget('reservation');
        return to_route('thankyou');
    }
}
