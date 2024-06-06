<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarDetail;
use DB;
use App\Models\Admincar;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Selfdrive;

class AdminController extends Controller
{

       public function administrator(){

         $data = CarDetail::get();

           return view('administrator' , compact('data'));
       }

       public function addcar(){
        return view('addingcar');
       }

       public function dashboard()
       {
        $admincar = Admincar::count();
        $user = User::count();
        $feedback = Feedback::count();
        $booking = Booking::count();
        $selfdrive = Selfdrive::count();
        //   Merge booking and selfdrive
        $totalbook = $booking + $selfdrive;

        return view('admin/dashboard' , [
            'admincar' => $admincar,
            'user'  => $user,
            'feedback'  => $feedback,
            'totalbook'  => $totalbook,

        ]);
       }
       


}
