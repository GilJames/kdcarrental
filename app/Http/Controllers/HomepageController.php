<?php

namespace App\Http\Controllers;

use App\Models\Admincar;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Selfdrive; 
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {   
        $feedbacks = Feedback::latest()->take(4)->get();


        $data = Admincar::all();
        $bookings = Booking::where('status', '!=', 'confirm')->get();
        $selfdrives = Selfdrive::where('status', '!=', 'confirm')->get();
        return view('layouts.homepage.index', compact('data', 'bookings', 'selfdrives', 'feedbacks'));
    }
}
