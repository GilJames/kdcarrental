<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admincar;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Selfdrive;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AdmincarFormRequest;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdmincarController extends Controller
{

    public function index()
    {


        $admincar = Admincar::count();
        $user = User::count();
        $feedback = Feedback::count();
        $booking = Booking::count();
        $selfdrive = Selfdrive::count();
        //   Merge booking and selfdrive
        $totalbook = $booking + $selfdrive;

        return view('admin/dashboard', [
            'admincar' => $admincar,
            'user'  => $user,
            'feedback'  => $feedback,
            'totalbook'  => $totalbook,
        ]);
    }
    public function admincar()
    {

        $data = Admincar::paginate(10);
        // $data = Admincar::with('bookings.feedback','selfbookings.feedback')->get();

        $bookings = Booking::where('status', '!=', 'confirmed')->paginate(10);

        // return response()->json([
        //     'data' => $data
        // ]);
        return view('admincar.admincar', compact('data' , 'bookings'));
    }


    // public function admincar()
    //     {
    //         $data = Admincar::get();
    //         $bookings = Booking::where('status', '!=', 'confirmed')->pluck('admincars_id')->toArray();
    //         return view('admincar.admincar', compact('data', 'bookings'));
    //     }

    public function addcar()
    {
        return view('admincar.addcar');
    }
    public function savecar(AdmincarFormRequest $request)
    {

        $validateData = $request->validated();

        $data = new Admincar();

        $data->carname = $validateData['carname'];
        $data->carprice = $validateData['carprice'];
        $data->carmodel = $validateData['carmodel'];
        $data->carseats = $validateData['carseats'];
        $data->carhistory = $validateData['carhistory'];
        $data->fueltype = $validateData['fueltype'];
        $data->cartype = $validateData['cartype'];
        $data->status = $validateData['status'];

        if ($request->hasfile('image')) {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/car/', $filename);
            $data->image = $filename;

            $user = Auth::User();
            Session::put('user', $user);
            $user = Session::get('user');

            $name       = $user->name;
            $email      = $user->email;
            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();

            $activityLog = [

                'name'        => $name,
                'email'       => $email,
                'description' => 'Admin added car',
                'date_time'   => $todayDate,
            ];

            $data->save();
        }

        DB::table('admin_activity_logs')->insert($activityLog);
        return redirect()->back()->with('info', 'Car Added Successfuly');
    }

    public function editcar($id)
    {

        $data = Admincar::where('id', '=', $id)->first();
        return view('admincar.edit', compact('data'));
    }
    public function uploadcars(AdmincarFormRequest $request, $id)
    {
        $validateData = $request->validated();
        $data = Admincar::find($id);

        $data->carname = $validateData['carname'];
        $data->carprice = $validateData['carprice'];
        $data->carmodel = $validateData['carmodel'];
        $data->carseats = $validateData['carseats'];
        $data->carhistory = $validateData['carhistory'];
        $data->fueltype = $validateData['fueltype'];
        $data->cartype = $validateData['cartype'];
        $data->status = $validateData['status'];
        if ($request->hasfile('image')) {
            $destination = '/..uploads/car/' . $data->image;


            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/car/', $filename);
            $data->image = $filename;
        }

            $user = Auth::User();
            Session::put('user', $user);
            $user = Session::get('user');

            $name       = $user->name;
            $email      = $user->email;
            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();

            $activityLog = [

                'name'        => $name,
                'email'       => $email,
                'description' => 'Admin edited car',
                'date_time'   => $todayDate,
            ];


        $data->save();
        DB::table('admin_activity_logs')->insert($activityLog);
        return redirect()->back()->with('info', 'Car Updated Successfully');
    }


    // public function delete($id)
    // {


    //     $data = Admincar::where('id', '=', $id)->first();

    //     $destination = '../uploads/cars/' . $data->image;

    //     if (File::exists($destination)) {
    //         File::delete($destination);
    //     }
    //     $data->delete();

    //     return redirect('admincar')->with('message', 'Car Deleted Successfully');
    // }


    //  DISABLE AND ENABLE SA SAKYANAN SA ADMINCAR



    public function enablecar($id)
    {


        $data = Admincar::find($id);

        $data->status = 'available';


        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'Admin enabled car',
            'date_time'   => $todayDate,
        ];

        $data->save();
        DB::table('admin_activity_logs')->insert($activityLog);
        return redirect()->back();
    }
    public function disablecar($id)
    {


        $data = Admincar::find($id);

        $data->status = 'notavailable';

        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'Admin disabled car',
            'date_time'   => $todayDate,
        ];

        $data->save();
        DB::table('admin_activity_logs')->insert($activityLog);
        return redirect()->back();
    }
}
