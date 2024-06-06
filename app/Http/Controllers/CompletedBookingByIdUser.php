<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Selfdrive;
use Illuminate\Http\Request;

class CompletedBookingByIdUser extends Controller
{
    public function index($id)
    {
        $data = Booking::where([
            'user_id' => $id,
            'status' => 'completed',
        ])->paginate(5);

        $selfdrive = Selfdrive::where([
            'user_id' => $id,
            'status' => 'completed',
        ])->paginate(5);

        
        return view('users.completed-booking.index',compact('data','selfdrive'));
    }
}
