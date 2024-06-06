<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        // return '/admin/dashboard';
        return 'home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'middlename' => $data['middlename'],
            'surname' => $data['surname'],
            'photo' => $data['photo'],
            'email' => $data['email'],
            'number' => $data['number'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function usersdata()
    {
        $User = User::get();
        return view('admin/reg-users', compact('User'));
    }
    public function getRegions(){
        return response()->json([
            'regions' => DB::table('refregion')->get(),
        ]);
    }
    public function getProvince(Request $request){
        return response()->json([
            'provinces' => DB::table('refprovince')->where('regCode', $request->regCode)->orderBy('provDesc', 'asc')->get(),
        ]);
    }
    public function getCities(Request $request){
        return response()->json([
            'cities' => DB::table('refcitymun')->where('provCode', $request->provCode)->orderBy('citymunDesc', 'asc')->get(),
        ]);
    }
    public function getBarangays(Request $request){
        return response()->json([
            'barangays' => DB::table('refbrgy')->where('citymunCode', $request->citymunCode)->orderBy('brgyDesc', 'asc')->get(),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $user->sendEmailVerificationNotification();
    }
}
