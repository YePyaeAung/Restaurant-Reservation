<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne()
    {
        return 'Step One Reservations';
    }
    public function stepTwo()
    {
        return 'Step Two Reservations';
    }
}