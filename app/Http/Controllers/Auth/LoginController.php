<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        $activityLog = [
            'name' => $email,
            'email' => $email,
            'description' => 'has logged in',
            'date_time' => $todayDate,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user is banned
            if ($user->banned_at !== null) {
                Auth::logout(); // Log the user out
                return redirect('/')->with('error', 'Your account is banned. Please contact support.');
            }

            // Log activity
            DB::table('activity_logs')->insert($activityLog);

            // Redirect based on user role
            switch ($user->role) {
                case 0:
                    return redirect()->route('admin.dashboard');
                    break;
                case 1:
                    return redirect()->route('user.dashboard');
                    break;
                default:
                    // Auth::logout();
                    // return redirect('/login');
                    break;
            }
        } else {
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }



    public function logout()
    {
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
            'description' => 'has logged out',
            'date_time'   => $todayDate,
        ];

        DB::table('activity_logs')->insert($activityLog);
        Auth::logout();
        return redirect('/');
    }
}
