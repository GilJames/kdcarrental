<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admincar;
use App\Models\Feedback;
use App\Models\Booking;
use App\Models\Selfdrive;
use App\Models\Drivers;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;


class HomesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function availablecars(){
        $data = Admincar::all();
        $bookings = Booking::where('status', '!=', 'confirm')->get();
        $selfdrives = Selfdrive::where('status', '!=', 'confirm')->get();
        $feedbacks = Feedback::latest()->take(4)->get();

        return view('availablecars', compact('data','bookings','selfdrives','feedbacks'));
    }

    public function viewcardetails($id){
        $data = Admincar::find($id);
        $reviews = Feedback::where('admincars_id', $id)->get();
        $overallRating = $reviews->avg('rating');
        return view('viewcardetail', compact('data', 'reviews', 'overallRating'));
    }

    public function search(Request $request){


        $search= $request->input('search');

        $data = Admincar::query()
        ->where('carname' , 'LIKE', "%{$search}%")
        ->orWhere('carmodel' , 'LIKE', "%{$search}%")
        ->OrWhere('cartype' , 'LIKE', "%{$search}%")
        ->orWhere('fueltype' , 'LIKE', "%{$search}%")
        ->orWhere('carseats' , 'LIKE', "%{$search}%")
        ->orWhere('status' , 'LIKE', "%{$search}%")
        ->get();

        return view('availablecars' , compact('data'));

    }

    // Booking details
    public function bookdetails($id)
    {

        // $data = Booking::where('admincars_id', $id)->orWhere('drivers_id', $id)->orWhere('user_id', $id)->get();

        $data = Booking::where(function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(5);


        $selfdrive = Selfdrive::where(function ($query) use ($id) {
            $query->where('user_id', $id);
        })->paginate(5);

        return view('bookingDetails.booking_details', [
            'data' => $data,
            'selfdrive' => $selfdrive,
        ]);

    }


    //    public function selfdrive($id){

    //     $data = Booking::where(function ($query) use ($id) {
    //         $query->where('', $id);
    //     })->get();

    //     $selfdrive = Selfdrive::where(function ($query) use ($id) {
    //         $query->where('user_id', $id);
    //     })->get();


    //     return view('bookingDetails.booking_details', compact('selfdrive', 'data'));
    //    }
    public function mybook($id){
        $data = Booking::where('user_id', $id)->paginate(5);

        foreach ($data as $booking) {
            if (now() > new Carbon($booking->expiration_time) && $booking->status === 'Pending') {
                $booking->status = 'Expired';
                $booking->save();
            }
        }

        $selfdrive = Selfdrive::where('user_id', $id)->paginate(5);

        return view('mybookings.mybook', [
            'data' => $data,
            'selfdrive' => $selfdrive,
        ]);
    }
}

