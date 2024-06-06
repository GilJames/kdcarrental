<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Selfdrive;
use Illuminate\Support\Facades\Auth;
use App\Models\Admincar;
use App\Models\Booking;
use App\Models\BookingDetail;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;

class SelfdriveController extends Controller
{
    public function selfdrive_form($id)
    {

        $data = Admincar::where('id', '=', $id)->first();


        $dat = Booking::where([
            'admincars_id' => $id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            DB::raw('NULL as license'),
            DB::raw("'bookingModel' as model_type"),
        );
        $self = Selfdrive::where([
            'admincars_id' => $id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            'license',
            DB::raw("'selfDriveModel' as model_type"),
        );

        $bookings = $dat->union($self)->get();

        $selfdrive = Selfdrive::get();

        return view('selfdrive_form',[
            'selfdrive' => $selfdrive,
            'data' => $data,
            'bookings' => $bookings,
        ]);
        // asd
    }

    public function selfdrivebook(Request $request)
    {
        $request->validate([
            'pickupdate' => 'required',
            'pickuptime' => 'required',
            'dropoffdate' => 'required',
            'dropofftime' => 'required',
            'destination' => 'required',
            'daytrip' => 'required',
            'license' => 'required',

        ]);


        $cardetail = Admincar::find($request->input('car_by_id'));
        $data = new Selfdrive();

        $data->user_id = Auth::id();

        $data->admincars_id = $request->input('car_by_id');

        $data->carname = $cardetail->carname;
        $data->carprice = $cardetail->carprice;
        $data->carmodel = $cardetail->carmodel;
        $data->carseats = $cardetail->carseats;


        $data->pickupdate = $request->input('pickupdate');
        $data->pickuptime = $request->input('pickuptime');
        $data->dropofftime = $request->input('dropofftime');
        $data->dropoffdate = $request->input('dropoffdate');
        $data->destination = $request->input('destination');
        $data->daytrip = $request->input('daytrip');
        $data->license = $request->input('license');
        $data->status = $request->input('status');

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
            'description' => 'Created Selfdrive Book',
            'date_time'   => $todayDate,
        ];
        $data->save();
        DB::table('activity_logs')->insert($activityLog);


        // return redirect()->route('bookdetails', ['id' => $request->input('car_by_id')]);
        return redirect()->back()->with('message', 'You have successfully submitted your booking');
    }



        //  Admin Selfdrive booking


        public function store_booking_selfdrive(Request $request){


            $request->validate([
                'self_user_id' => 'required',
                'self_admincars_id' => 'required', // Ensure this is the car's ID
                'self_pickupdate' => 'required|date',
                'self_pickuptime' => 'required',
                'self_dropoffdate' => 'required|date',
                'self_dropofftime' => 'required',
                'self_destination' => 'required|string',
                'self_daytrip' => 'required|integer',
                'self_license' => 'required|string',
            ]);
        
            // Fetch the selected car details from the database
            $carDetail = Admincar::findOrFail($request->input('self_admincars_id')); // This should be the ID of the car
            $data = new Selfdrive();
            $data->user_id = $request->input('self_user_id');
            $data->admincars_id = $carDetail->id;
            $data->carname = $carDetail->carname;
            $data->carprice = $carDetail->carprice;
            $data->carmodel = $carDetail->carmodel;  // Include car model
            $data->carseats = $carDetail->carseats;  // Include car seats
            $data->pickupdate = $request->input('self_pickupdate');
            $data->pickuptime = $request->input('self_pickuptime');
            $data->dropoffdate = $request->input('self_dropoffdate');
            $data->dropofftime = $request->input('self_dropofftime');
            $data->destination = $request->input('self_destination');
            $data->license = $request->input('self_license');
            $data->daytrip = $request->input('self_daytrip');
            $data->status = $request->input('self_status');
        
            // Calculate total payment
            $totalPayment = $request->input('self_daytrip') * $carDetail->carprice;
            $data->total_payment = $totalPayment;
        
            $data->save(); // Save the booking
            // Log the activity
            $activityLog = [
                'name'        => auth()->user()->name,
                'email'       => auth()->user()->email,
                'description' => 'Created Withdriver Book',
                'date_time'   => now()->toDayDateTimeString(),
            ];

            DB::table('activity_logs')->insert($activityLog);

            return redirect()->back()->with('message', 'You have successfully submitted your booking');
            }

}
