<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    //

    // public function myprofile ($id){

    //    $data = User::find($id);
    //     return view('myprofile' , compact('data'));
    // }

    public function myprofile ($id){

        $data = User::find($id);
        return view('myprofile' , compact('data'));
     }

    //  public function editprofile($id){

    //       $data = User::where('id' , '=' , $id);
    //       return view('editprofile' , compact('data'));

    //  }


        public function editprofile($id){

            $data = User::where('id' , '=' , $id)->first();
            return view('editprofile' , compact('data'));

        }
        public function updateProfile(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
                'password' => ['required', 'string', 'min:8'],
                'photo' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Added validation for photo
                'number' => ['nullable', 'string', 'max:255'],
                'address' => ['nullable', 'string', 'max:255'],
            ]);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'number' => $request->input('number'),
                'address' => $request->input('address'),
                'password' => Hash::make($validatedData['password']),
            ]);

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/profile/', $filename);
                $user->photo = $filename;
            }

            $user->save();

            // Log activity
            $loggedInUser = Auth::user();
            $activityLog = [
                'name' => $loggedInUser->name,
                'email' => $loggedInUser->email,
                'description' => 'Edit User Profile',
                'date_time' => now(),
            ];
            DB::table('activity_logs')->insert($activityLog);

            return redirect()->back()->with('message', 'User Profile Updated Successfully');
        }



    //    ADMIN PROFILE SETTINGS

       public function adminprofile(){

        $id = auth()->user()->id;
           $data = User::find($id);
           return view('admin.adminprofile' , [
            'data' => $data
           ]);


       }

    //    public function adminedit($id){

    //     $data = User::find($id);
    //     return view('admin.adminprofile' , compact('data'));

    // }

     public function updated(Request $request , $id){

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['required', 'string', 'min:8'],
            // Add validation rules for other fields if necessary
        ]);

        $data = User::find($id);

        $data->name = $validateData['name'];
        $data->email = $validateData['email'];
        $data->number = $request->input('number');
        $data->address = $request->input('address');
        $data->password = Hash::make($validateData['password']); // Hash the password and set it
        if($request->hasfile('photo'))
        {

        $file =$request->file('photo');
        $extension = $file->getClientOriginalExtension();
        $filename = time(). '.' .$extension;
        $file->move('uploads/profile/' ,$filename);
        $data->photo = $filename;

        }
        $data->save();
         return redirect()->back()->with('message','Profile is successfully updated');

    }

     }

