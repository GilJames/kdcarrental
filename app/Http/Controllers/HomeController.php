<?php

namespace App\Http\Controllers;

use App\Models\Admincar;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Selfdrive;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feedbacks = Feedback::latest()->take(4)->get();


        $data = Admincar::all();
        $bookings = Booking::where('status', '!=', 'confirm')->get();
        $selfdrives = Selfdrive::where('status', '!=', 'confirm')->get();
        return view('home', compact('data', 'bookings', 'selfdrives', 'feedbacks'));
    }
    public function about_us()
    {
        $data = Admincar::all();
        return view('about-us', compact('data'));
    }
}
