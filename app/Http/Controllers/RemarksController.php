<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admincar;
use App\Models\Remarks;
use App\Models\Booking;
use App\Models\Selfdrive;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RemarksController extends Controller
{
    public function userRemarks(Request $request)
    {

        $request->validate([
            'comment' => 'required',
            'rate' => 'required|integer',
        ]);

        $booking_id = $request->input('booking_id');
        $model = $request->input('model');


        if ($model === 'withdrive') {
            Booking::where('id', $booking_id)->update([
                'lastrate' => Carbon::now()->toDateString(),
            ]);
        } elseif ($model === 'selfdrive') {
            Selfdrive::where('id', $booking_id)->update([
                'lastrate' => Carbon::now()->toDateString(),
            ]);
        }

        $remark = new Remarks();
        $remark->booking_id = $booking_id;
        $remark->users_id = Auth::user()->id;
        $remark->cars_id = $request->input('cars_id');
        $remark->comment = $request->input('comment');
        $remark->rate = $request->input('rate');
        $remark->booking_model = $model;

        $remark->save();

        return redirect()->back()->with('message', 'Your rating has successfully been posted');
    }

    public function getUserRemarks($id)
    {
        $remarks = Remarks::with(['users' => function($query) {
            $query->select('id', 'name', 'role'); // Include role and profile image assuming these fields exist
        }])
         ->where('users_id', $id)
         ->orderBy('created_at', 'desc')
         ->get();

        return response()->json($remarks);
        }

}
