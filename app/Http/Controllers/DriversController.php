<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drivers;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DriversController extends Controller
{
    public function driver()
    {
        $data = Drivers::all();

        return view('drivers_details' , compact('data'));

    }



    public function admindriver(){

       $admindriver = Drivers::paginate(10);

       return view('admindriver.admindriver' , compact('admindriver'));


    }
    public function addriver(){

         return view('admindriver.addriver');

    }
    public function savedriver(Request $request){

            $data = new Drivers();


            $data->name = $request->input('name');
            $data->address = $request->input('address');
            $data->yearsofexperience = $request->input('yearsofexperience');
            $data->number = $request->input('number');
            $data->license = $request->input('license');
            $data->statusdriver = $request->input('statusdriver');

            if ($request->hasfile('profile')) {

                $file = $request->file('profile');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/drivers/', $filename);
                $data->profile = $filename;


                 // ADMIN ACTIVITY LOG
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
                        'description' => 'Admin added driver',
                        'date_time'   => $todayDate,
                    ];

                $data->save();
                DB::table('admin_activity_logs')->insert($activityLog);
                return redirect()->back()->with('message' , 'New Driver Added Successfully');
            }

        }
                public function editdriver($id){

                    $data = Drivers::where('id' , '=' , $id)->first();
                    return view('admindriver.editdriver' ,compact('data'));

             }

              public function updatedriver(Request $request , $id){

                $data = Drivers::find($id);

                $data->name = $request->input('name');
                $data->address = $request->input('address');
                $data->yearsofexperience = $request->input('yearsofexperience');
                $data->number = $request->input('number');
                $data->license = $request->input('license');
                $data->statusdriver = $request->input('statusdriver');

                if ($request->hasfile('profile')) {

                $destination = 'uploads/drivers/'.$data->profile;

                      if(File::exists($destination)){
                        File::delete($destination);
                      }

                    $file = $request->file('profile');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/drivers/', $filename);
                    $data->profile = $filename;

                }

                // ADMIN ACTIVITY LOG
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
                    'description' => 'Admin edited driver',
                    'date_time'   => $todayDate,
                ];

                $data->save();
                DB::table('admin_activity_logs')->insert($activityLog);
                return redirect('admindriver')->with('message' , 'Driver Updated Successfully');

              }

                 public function deleteadmin($id){

                  $data = Drivers::find($id);

                $destination = '../uploads/drivers/'.$data->profile;

                  if(File::exists($destination)){
                    File::delete($destination);
                  }

                 // ADMIN ACTIVITY LOG
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
                    'description' => 'Admin deleted driver',
                    'date_time'   => $todayDate,
                ];


                  $data->delete();
                    DB::table('admin_activity_logs')->insert($activityLog);
                  return redirect('admindriver')->with('message' , 'Driver Deleted Successfully');

                 }

}
