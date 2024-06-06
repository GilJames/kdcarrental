<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Selfdrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class CancelledBookingByIdUser extends Controller
{
    public function index($id)
    {
        $data = Booking::where([
            'user_id' => $id,
            'status' => 'cancelled',
        ])->paginate(5);

        $selfdrive = Selfdrive::where([
            'user_id' => $id,
            'status' => 'cancelled',
        ])->paginate(5);
        return view('users.cancelled-booking.index',compact('data','selfdrive'));
    }
    public function cancel_by_user(Request $request)
    {
        $id = $request->input('bk_id');
        $driveType = $request->input('driveType');

        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'Cancelled Booked',
            'date_time'   => $todayDate,
        ];

        if($driveType == 'withDriver'){
            Booking::where('id', $id)->update([
                'status' => 'cancelled',
                'cancelled_reason' => $request->input('reason'),
            ]);
        }
        elseif($driveType == 'selfDrive'){
            Selfdrive::where('id', $id)->update([
                'status' => 'cancelled',
                'cancelled_reason' => $request->input('reason'),
            ]);
        }
        DB::table('activity_logs')->insert($activityLog);
        return redirect()->back()->with('success', 'Cancelled Success');
    }
}
