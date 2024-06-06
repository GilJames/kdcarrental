<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AdminuserFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class AdminuserController extends Controller
{

     public function adminuser()
     {

          $data = User::paginate(10);
          return view('admin.adminuser', compact('data'));
     }

     public function searchUser(Request $request)
     {

          $search = $request->input('searchUser');

          $data = User::query()
               ->where('id', 'LIKE', "%{$search}%")
               ->orWhere('name', 'LIKE', "%{$search}%")
               ->orWhere('email', 'LIKE', "%{$search}%")
               ->orWhere('number', 'LIKE', "%{$search}%")
               ->orWhere('address', 'LIKE', "%{$search}%")
               ->orWhere('role', 'LIKE', "%{$search}%")
               ->paginate(10);

          return view('admin.adminuser', compact('data'));
     }


     public function revoke(Request $request)
     {
          if (!empty($request->id)) {
               $user = User::find($request->id);
               $user->unban();
               DB::table('bans')->where('bannable_id', $request->id)->delete();

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
                    'description' => 'Admin revoked user',
                    'date_time'   => $todayDate,
               ];

               DB::table('admin_activity_logs')->insert($activityLog);
          }
          return response()->json(['message' => 'revoked']);
          // return redirect()->route('adminuser')->with('success', 'User Revoke Successfully.');
     }

     public function adduser()
     {

          return view('admin.adduser');
     }


     public function saveuser(Request $request)
     {

          $data = new User();

          $data->name = $request->input('name');
          $data->email = $request->input('email');
          $data->number = $request->input('number');
          $data->address = $request->input('address');
          $data->password = bcrypt($request->input('password')); // Hash the password and set it



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
               'description' => 'Admin added user',
               'date_time'   => $todayDate,
          ];

          $data->save();
          DB::table('admin_activity_logs')->insert($activityLog);
          return redirect()->back()->with('message', 'User Added Successfully');
     }

     public function edituser($id)
     {

          $data = User::where('id', '=', $id)->first();
          return view('admin.edituser', compact('data'));
     }
     public function updateuser(Request $request, $id)
     {
               $validateData = $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                    // Add validation rules for other fields if necessary
               ]);

               $data = User::find($id);

               $data->name = $validateData['name'];
               $data->email = $validateData['email'];
               $data->number = $request->input('number');
               $data->address = $request->input('address');
               $data->role = $request->input('role');
               if($request->password == NULL) {
                    $data->password = Hash::make($validateData['password']);
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
                   'description' => 'Admin edited user',
                   'date_time'   => $todayDate,
               ];

               $data->save();
               DB::table('admin_activity_logs')->insert($activityLog);

               return redirect()->back()->with('message', 'User Updated Successfully');
     }

     //  public function deleteuser($id)
     //  {


     //       $data = User::where('id', "=", $id)->delete();

     //       return redirect()->back()->with('message', 'User Deleted Successfully');
     //  }

     public function userBanWithreason(Request $request)
     {

          if (!empty($request->id)) {

               $user = User::find($request->id);

               $user->bans()->create([
                    'expired_at' => '+1 month',
                    'comment' => $request->comment,
               ]);

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
                    'description' => 'Admin banned user',
                    'date_time'   => $todayDate,
               ];

               DB::table('admin_activity_logs')->insert($activityLog);
          }

          return response()->json(['message' => 'banned']);
     }

     //   ANOTHER METHOD SA UPDATE
     //      public function updateuser(Request $request, $id)
     // {
     //     $data = User::find($id);

     //     $data->name = $request->input('name');
     //     $data->email = $request->input('email');
     //     $data->number = $request->input('number');
     //     $data->address = $request->input('address');

     //     // Check if a new password is provided
     //     if ($request->has('password')) {
     //         $data->password = bcrypt($request->input('password')); // Hash the new password and set it
     //     }

     //     $data->save();
     //     return redirect()->back()->with('message', 'User Updated Successfully');
     // }



}
