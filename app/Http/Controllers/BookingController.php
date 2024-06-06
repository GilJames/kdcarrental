<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Admincar;
use App\Models\User;
use App\Models\Drivers;
use App\Models\Selfdrive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\BookingformRequest;
use App\Models\BookingDetail;
use App\Models\Totalsale;
use Notification;
use App\Notifications\ConfirmedBookingNotificationByIdUser;
use App\Notifications\RejectedBookingNotificationByIdUser;
use Illuminate\Notifications\Notification as NotificationsNotification;
use PHPUnit\Framework\Error\Notice;
use Carbon\Carbon;
use Session;

class BookingController extends Controller
{


    // In your controller

    public function rejectBooking(Request $request)
    {
        try {
            $bookingId = $request->input('bookingId');
            $status = $request->input('status');
            $model = $request->input('model');

            // Update the Booking table based on the status
            if ($status === 'reject') {
                if ($model === 'bookingModel') {
                    Booking::where('id', $bookingId)->update([
                        'status' => 'reject',
                        'reject_reason' => $request->input('rejectionReason'),
                        'confirmed_OR' => null,
                    ]);
                } elseif ($model === 'selfDriveModel') {
                    Selfdrive::where('id', $bookingId)->update([
                        'status' => 'reject',
                        'reject_reason' => $request->input('rejectionReason'),
                        'confirmed_OR' => null,
                    ]);
                }

                $sentTo = Booking::find($bookingId);
                $user = User::find($sentTo->user_id);

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
                    'description' => 'Admin rejected booking',
                    'date_time'   => $todayDate,
                ];

                DB::table('admin_activity_logs')->insert($activityLog);


                // $user = User::find($bookingId);
                if ($user) {

                    $details = [
                        'greeting' => 'Hi ' . $user->name . ',',
                        'body' => 'I hope this message finds you well. We regret to inform you that, unfortunately, we are unable to process your recent booking request. After careful consideration, we have identified the following reason for the rejection: (' . ucfirst($request->input('rejectionReason')) . ')',
                        'actiontext' => 'Visit our page',
                        'actionurl' => '/',
                        'lastline' => 'Thank you for considering our service, and we hope to have the opportunity to serve you in the future.',
                    ];


                    // User found, send the notification
                    //   $user->notify(new RejectedBookingNotificationByIdUser($details));

                    Notification::send($user, new RejectedBookingNotificationByIdUser($details));
                } else {
                    // User not found, handle accordingly (e.g., log, redirect, etc.)
                    // return redirect()->back()->with('error', 'User not found.');


                    return response()->json(['status' => 'error']);
                }


                // Notification::send($user, new ConfirmedBookingNotificationByIdUser($details));
                // $user->notify(new ConfirmedBookingNotificationByIdUser());



            } elseif ($status === 'confirm') {

                if ($model === 'bookingModel') {
                    Booking::where('id', $bookingId)->update([
                        'status' => 'confirm',
                        'confirmed_OR' => $request->input('officialReceipt'),
                        'reject_reason' => null,
                    ]);
                } elseif ($model === 'selfDriveModel') {
                    Selfdrive::where('id', $bookingId)->update([
                        'status' => 'confirm',
                        'confirmed_OR' => $request->input('officialReceipt'),
                        'reject_reason' => null,
                    ]);
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
                    'description' => 'Admin confirmed booking',
                    'date_time'   => $todayDate,
                ];

                DB::table('admin_activity_logs')->insert($activityLog);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function completed_reports(Request $request)
    {
        $month = $request->input('month');

        $data = Booking::where('status', 'completed')->with(['user', 'admincar'])->where(function ($query) use ($month) {
            $query->where('pickupdate', 'like', "%$month%")
                ->orWhere('dropoffdate', 'like', "%$month%");
        })->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }


    public function updateSession(Request $request)
    {
        $selectedOption = $request->input('selectedOption');

        // Validate $selectedOption if needed

        // Update the session variable
        session(['selectedOption' => $selectedOption]);

        // You can return a response if necessary
        return response()->json(['success' => true]);
    }

    public function getCarPrice(Request $request)
    {
        $id = Admincar::find($request->input('id'));

        return response()->json([
            'status' => 'success',
            'id' => $id,
        ]);
    }


    public function bookingform($id)
    {
        $data = Admincar::where('id', '=', $id)->first();

        // $withDriver = Booking::where([
        //     'admincars_id' => $id,
        //     'status' => 'pending'
        // ])->orWhere('status', 'confirm')
        //     ->orWhere('status', 'To_pay')->get();

        // $selfdrive = Selfdrive::where([
        //     'admincars_id' => $id,
        //     'status' => 'pending'
        // ])->orWhere('status', 'confirm')
        //     ->orWhere('status', 'To_pay')->get();

        // $bookings = $withDriver->merge($selfdrive);

        $dat = Booking::where([
            'admincars_id' => $id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            DB::raw('NULL as license'),
            DB::raw("'bookingModel' as model_type"),
        );
        $self = Selfdrive::where([
            'admincars_id' => $id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            'license',
            DB::raw("'selfDriveModel' as model_type"),
        );

        $bookings = $dat->union($self)->get();


        return view('booking_form', [
            'data' => $data,
            'bookings' => $bookings,

        ]);
    }

    public function bookingsave(Request  $request)
    {
        $cardetail = Admincar::find($request->input('car_by_id'));
        $data = new Booking();
        $data->user_id = Auth::id();
        $data->admincars_id = $request->input('car_by_id');

        $data->carname = $cardetail->carname;
        $data->carprice = $cardetail->carprice;
        $request->validate([
            'pickupdate' => 'required',
            'pickuptime' => 'required',
            'dropoffdate' => 'required',
            'dropofftime' => 'required',
            'destination' => 'required',
            'daytrip' => 'required',

        ]);

        $data->carprice = $cardetail->carprice;
        $data->carmodel = $cardetail->carmodel;
        $data->carseats = $cardetail->carseats;


        $data->pickupdate = $request->input('pickupdate');
        $data->pickuptime = $request->input('pickuptime');
        $data->dropofftime = $request->input('dropofftime');
        $data->dropoffdate = $request->input('dropoffdate');
        $data->destination = $request->input('destination');
        $data->daytrip = $request->input('daytrip');
        $data->status = $request->input('status');

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
            'description' => 'Created Withdriver Book',
            'date_time'   => $todayDate,
        ];
        $data->save();
        DB::table('activity_logs')->insert($activityLog);

        // return redirect()->route('bookdetails', ['id' => $request->input('car_by_id')]);
        return redirect()->back()->with('message', 'You have successfully submitted your booking');
    }

    // ADMIN SIDE NI PAG FETCH SA WITHDRIVER

    public function bookingwithdriver(Request $request)
    {
        $data = Booking::with('admincar', 'user')
            ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->searchBooking != null, function ($q) use ($request) {
                return $q->where(function ($query) use ($request) {
                    $query->whereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'LIKE', "%{$request->searchBooking}%");
                    })
                        ->orWhereHas('admincar', function ($admincarQuery) use ($request) {
                            $admincarQuery->where('carname', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('carprice', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickupdate', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickuptime', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('destination', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('daytrip', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('status', 'LIKE', "%{$request->searchBooking}%");
                        });
                });
            })
            ->paginate(10);

        $selfdrive = Selfdrive::with('admincar', 'user')
            ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->searchBooking != null, function ($q) use ($request) {
                return $q->where(function ($query) use ($request) {
                    $query->whereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'LIKE', "%{$request->searchBooking}%");
                    })
                        ->orWhereHas('admincar', function ($admincarQuery) use ($request) {
                            $admincarQuery->where('carname', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('carprice', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickupdate', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickuptime', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('destination', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('daytrip', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('status', 'LIKE', "%{$request->searchBooking}%");
                        });
                });
            })
            ->paginate(10);

        $dat = Booking::with('admincar', 'user')->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            DB::raw('NULL as license'),
            DB::raw("'bookingModel' as model_type"),
        );

        $self = Selfdrive::with('admincar', 'user')->select(
            'id',
            'user_id',
            'admincars_id',
            'pickuptime',
            'pickupdate',
            'dropofftime',
            'dropoffdate',
            'destination',
            'daytrip',
            'status',
            'reject_reason',
            'cancelled_reason',
            'confirmed_OR',
            'total_payment',
            'lastrate',
            'license',
            DB::raw("'selfDriveModel' as model_type"),
        );

        $all = $dat->union($self)
            ->when($request->searchBooking != null, function ($q) use ($request) {
                return $q->where(function ($query) use ($request) {
                    $query->whereHas('user', function ($userQuery) use ($request) {
                        $userQuery->where('name', 'LIKE', "%{$request->searchBooking}%");
                    })
                        ->orWhereHas('admincar', function ($admincarQuery) use ($request) {
                            $admincarQuery->where('carname', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('carprice', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickupdate', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('pickuptime', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('destination', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('daytrip', 'LIKE', "%{$request->searchBooking}%")
                                ->orWhere('status', 'LIKE', "%{$request->searchBooking}%");
                        });
                });
            })
            ->paginate(10);

        return view('admin.bookingwithdriveradmin', compact('data', 'selfdrive', 'all'));
    }


    // public function searchBooking(Request $request){

    //     $search = $request->input('searchBooking');

    //     $all = Booking::query()
    //         ->whereHas('user', function ($userQuery) use ($search) {
    //             $userQuery->where('name', 'LIKE', "%{$search}%");
    //         })
    //         ->orWhereHas('admincar', function ($admincarQuery) use ($search) {
    //             $admincarQuery->where('carname', 'LIKE', "%{$search}%")
    //                 ->orWhere('carprice', 'LIKE', "%{$search}%")
    //                 ->orWhere('pickupdate', 'LIKE', "%{$search}%")
    //                 ->orWhere('pickuptime', 'LIKE', "%{$search}%")
    //                 ->orWhere('destination', 'LIKE', "%{$search}%")
    //                 ->orWhere('daytrip', 'LIKE', "%{$search}%")
    //                 ->orWhere('carprice', 'LIKE', "%{$search}%")
    //                 ->orWhere('status', 'LIKE', "%{$search}%");
    //         })
    //         ->paginate(10);

    //     return view('admin.bookingwithdriveradmin', compact('all'));

    // }

    public function bookingselfdrive()
    {


        $data = Selfdrive::with('admincar', 'user')->get();
        return view('admin.bookingwithselfdrive', compact('data'));
    }
    public function confirmstatus($id)
    {

        $data = Booking::find($id);
        $data->status = 'confirm';
        $data->save();
        return redirect()->back();
    }
    public function rejectstatus($id)
    {

        $data = Booking::find($id);
        $data->status = 'reject';
        $data->save();
        return redirect()->back();
    }
    public function completedstatus($id, $model)
    {
        if ($model === 'withdrive') {
            $data = Booking::find($id);
            $day = $data->daytrip;
            $price = $data->admincar->carprice;
            $total = $day * $price;
            $data->status = 'completed';
            $data->total_payment = $total;
            $data->save();

            $record = Totalsale::firstOrNew(['booked_id' =>  $id]);
            $record->month = date('F');
            $record->year =  date('Y');;
            $record->booked_id = $id;
            $record->model_booking = $model;
            $record->total = $total;

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
                'description' => 'Admin completed booking',
                'date_time'   => $todayDate,
            ];
            $record->save();
            DB::table('admin_activity_logs')->insert($activityLog);

        } elseif ($model === 'selfdrive') {
            $data = Selfdrive::find($id);
            $day = $data->daytrip;
            $price = $data->admincar->carprice;
            $total = $day * $price;
            $data->status = 'completed';
            $data->total_payment = $total;
            $data->save();

            $record = Totalsale::firstOrNew(['booked_id' =>  $id]);
            $record->month = date('F');
            $record->year =  date('Y');
            $record->booked_id = $id;
            $record->model_booking = $model;
            $record->total = $total;


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
                'description' => 'Admin completed booking',
                'date_time'   => $todayDate,
            ];


            $record->save();
            DB::table('admin_activity_logs')->insert($activityLog);
        }
        return redirect()->back();
        // return response()->json(['status' => 'Customer Booking Successfully Completed']);
    }
    public function selfconfirmstatus($id)
    {

        $data = Selfdrive::find($id);
        $data->status = 'confirm';
        $data->save();
        return redirect()->back();
    }
    public function selfrejectstatus($id)
    {

        $data = Selfdrive::find($id);
        $data->status = 'reject';
        $data->save();
        return redirect()->back();
    }
    public function selfcompletedstatus($id)
    {

        $data = Selfdrive::find($id);
        $data->status = 'completed';
        $data->save();
        return redirect()->back();
    }

    public function editdriverbooking($id)
    {

        $data = Booking::where('id', '=', $id)->first();
        $datas = Admincar::get();


        $withDriver = Booking::where('id', '!=', $id)->where([
            'admincars_id' => $data->admincars_id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'pickupdate',
            'dropoffdate',
            'status',
        );

        $selfdrive = Selfdrive::where([
            'admincars_id' => $data->admincars_id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'pickupdate',
            'dropoffdate',
            'status',
        );

        $bookings = $withDriver->union($selfdrive)->get();

        return view('editdriverbooking', compact('data', 'datas', 'bookings'));
    }
    public function updateuserbooking(Request $request)
    {
        // Find the booking record by ID
        $data = Booking::find($request->input('bookingId'));

        // Check if the record was found
        if (!$data) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        //    echo Auth::user()->id;
        //    echo  $data->admincars_id;
        //    echo  $request->input('admincars_idSelect');

        // Validate the incoming request data
        // $request->validate([
        //     'admincars_idSelect' => 'required', // Adjust this rule based on your needs
        //     'pickupdate' => 'required|date',
        //     'pickuptime' => 'required',
        //     'dropofftime' => 'required',
        //     'dropoffdate' => 'required|date',
        //     'destination' => 'required',
        //     'daytrip' => 'required',
        //     'status' => 'required',
        // ]);

        // Update the booking record with the new data
        $data->user_id = Auth::id();
        $data->admincars_id = $request->input('admincars_idSelect');
        $data->pickupdate = $request->input('pickupdate');
        $data->pickuptime = $request->input('pickuptime');
        $data->dropofftime = $request->input('dropofftime');
        $data->dropoffdate = $request->input('dropoffdate');
        $data->destination = $request->input('destination');
        $data->daytrip = $request->input('daytrip');
        $data->status = $request->input('status');




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
            'description' => 'Update Withdriver Book',
            'date_time'   => $todayDate,
        ];

        // Save the updated record
        $data->save();
        DB::table('activity_logs')->insert($activityLog);
        return redirect()->back()->with('message', 'Booking updated successfully.');
    }

    public function viewdriverbooking($id)
    {

        $bk = Booking::where('id', '=', $id)->first();

        return view('bookingDetails.booking_details', compact('bk'));
    }

    public function viewselfbooking($id)
    {

        $bk = Selfdrive::where('id', '=', $id)->first();

        return view('bookingDetails.booking_details', compact('bk'));
    }



    // EDIT SA SELFDRIVE BOOKING SA BOOKDETAILS

    public function editselfbooking($id)
    {

        $data = Selfdrive::where('id', '=', $id)->first();
        $datas = Admincar::get();

        $withDriver = Booking::where([
            'admincars_id' => $data->admincars_id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'pickupdate',
            'dropoffdate',
            'status',
        );

        $selfdrive = Selfdrive::where('id', '!=', $id)->where([
            'admincars_id' => $data->admincars_id,
        ])->whereIn('status', ['pending', 'confirm', 'To_pay'])->select(
            'pickupdate',
            'dropoffdate',
            'status',
        );

        $bookings = $withDriver->union($selfdrive)->get();
        // $bookings = $withDriver->merge($selfdrive);

        return view('editselfbooking', compact('data', 'datas', 'bookings'));
    }


    public function updateselfbooking(Request $request)
    {
        // Find the booking record by ID
        $data = Selfdrive::find($request->input('bookingId'));

        // Check if the record was found
        if (!$data) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        // Validate the incoming request data if needed
        // Example validation rules:
        // $request->validate([
        //     'pickupdate' => 'required',
        //     'pickuptime' => 'required',
        //     // Add more validation rules as needed
        // ]);

        // Update the booking record with the new data
        $data->user_id = Auth::id();

        $data->admincars_id = $request->input('admincars_idSelect');
        $data->pickupdate = $request->input('pickupdate');
        $data->pickuptime = $request->input('pickuptime');
        $data->dropofftime = $request->input('dropofftime');
        $data->dropoffdate = $request->input('dropoffdate');
        $data->destination = $request->input('destination');
        $data->daytrip = $request->input('daytrip');
        $data->license = $request->input('license');
        $data->status = $request->input('status');

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
            'description' => 'Update Selfdrive Book',
            'date_time'   => $todayDate,
        ];

        // Save the updated record
        $data->save();
        DB::table('activity_logs')->insert($activityLog);
        return redirect()->back()->with('message', 'Booking updated successfully.');
    }


    public function topay(Request $request)
    {
        $id = $request->input('id');
        $model = $request->input('model');

        if ($model === 'withdrive') {
            $data = Booking::find($id);
            $data->status = 'To_pay';
            $data->save();
        } elseif ($model === 'selfdrive') {
            $data = Selfdrive::find($id);
            $data->status = 'To_pay';
            $data->save();
        }

        $user = User::find($data->user_id);

        if ($user) {
            // User found, send the notification
            $user->notify(new ConfirmedBookingNotificationByIdUser());
        } else {
            // User not found, handle accordingly (e.g., log, redirect, etc.)
            // return redirect()->back()->with('error', 'User not found.');
            return response()->json(['status' => 'error']);
        }
        return response()->json(['status' => 'success']);
    }
    public function selftopay($id)
    {


        $data = Selfdrive::find($id);
        $data->status = 'To_pay';
        $data->save();

        return redirect()->back();
    }

    // public function total_sales(Request $request)
    // {
    //     // Get the year from the request
    //     $year = $request->input('year');

    //     // Fetch sales data from the database based on the year
    //     $salesData = Totalsale::where('year', $year)
    //         ->select('month', DB::raw('SUM(total) as total'))
    //         ->groupBy('month')
    //         ->get();

    //     return response()->json(['salesData' => $salesData]);
    // }
    public function getBookingById(Request $request)
    {
        // $bookings = Booking::where('admincars_id', $request->id)->get();

        $data = Booking::where('id', '=', $request->bk_id)->first();


        $withDriver = Booking::where('id', '!=', $request->bk_id)->where([
            'admincars_id' => $request->id,
            'status' => 'pending'
        ])->orWhere('status', 'confirm')
            ->orWhere('status', 'To_pay')->select(
                'pickupdate',
                'dropoffdate',
                'status',
            );

        $selfdrive = Selfdrive::where([
            'admincars_id' =>  $request->id,
            'status' => 'pending'
        ])->orWhere('status', 'confirm')
            ->orWhere('status', 'To_pay')->select(
                'pickupdate',
                'dropoffdate',
                'status',
            );

        $bookings = $withDriver->union($selfdrive)->get();

        return response()->json([
            'bookings' => $bookings
        ]);
    }

    public function expiredFunction()
    {
        // Get the current datetime in the timezone you're working with (e.g., UTC)
        $currentDateTime = Carbon::now('UTC');

        // Update the status of overdue bookings
        Booking::where('dropoffdate', '<=', $currentDateTime->toDateString())
            ->whereTime('dropofftime', '<=', $currentDateTime->toTimeString())
            ->update(['status' => 'expired']);

        // Update the status of overdue selfdrives
        Selfdrive::where('dropoffdate', '<=', $currentDateTime->toDateString())
            ->whereTime('dropofftime', '<=', $currentDateTime->toTimeString())
            ->update(['status' => 'expired']);


        return response()->json([
            'message' => true
        ]);
    }


    public function add_booking_withdriver(Request $request)
    {
        {
            $users = User::all();
            $cardetail = Admincar::find(request('admincars_id'));
            $userdetail = User::find(request('user_id'));

            return view('admin.bookingwithdriveradmin', compact('users', 'cardetail', 'userdetail','data'));
        }
    }

    // public function store_booking_withdriver(Request $request)
    // {

    //     $cardetail = Admincar::find($request->input('admincars_id'));
    //     $userdetail = User::find($request->input('user_id'));

    //     if (!$cardetail) {
    //         return back()->withErrors('Car details not found.')->withInput();
    //     }
    //     if (!$userdetail) {
    //         return back()->withErrors('User details not found.')->withInput();
    //     }

    //     $data = new Booking($request->all()); // Using mass assignment (ensure $fillable is defined in Booking model)
    //     $data->fill($request->only([
    //         'pickupdate',
    //         'pickuptime',
    //         'dropofftime',
    //         'dropoffdate',
    //         'destination',
    //         'daytrip',
    //         'status'  // Add all fields that are safe to mass assign and defined in the $fillable property of the Booking model.
    //     ]));

    //     $data->admincars_id = $cardetail->admincars_id;  // Assuming 'id' is the primary key for Admincar
    //     $data->carname = $cardetail->carname;
    //     $data->carprice = $cardetail->carprice;
    //     $data->carmodel = $cardetail->carmodel;
    //     $data->carseats = $cardetail->carseats;

    //     $data->user_id = $request->input('user_id'); // Assuming you want to save user's ID who is booking
    //     $data->pickupdate = $request->input('pickupdate');
    //     $data->pickuptime = $request->input('pickuptime');
    //     $data->dropofftime = $request->input('dropofftime');
    //     $data->dropoffdate = $request->input('dropoffdate');
    //     $data->destination = $request->input('destination');
    //     $data->daytrip = $request->input('daytrip');
    //     $data->status = $request->input('status');

    //     $user = Auth::User();
    //     Session::put('user', $user);
    //     $user = Session::get('user');
    //     $name       = $user->name;
    //     $email      = $user->email;
    //     $dt         = Carbon::now();
    //     $todayDate  = $dt->toDayDateTimeString();

    //     $activityLog = [

    //         'name'        => $name,
    //         'email'       => $email,
    //         'description' => 'Created Withdriver Book',
    //         'date_time'   => $todayDate,
    //     ];
    //     $data->save();

    //     DB::table('activity_logs')->insert($activityLog);

    //     // return redirect()->route('bookdetails', ['id' => $request->input('car_by_id')]);
    //     return redirect()->back()->with('message', 'yawaaaaaaaa');
    // }



    public function bookwithdriver(){

      $user = User::get();
      return view('bookwithdriver.bookwithdriver' , ['user'=> $user]);



    }


    // public function bookwithdriversave(Request $request){

    //      $book = Bookings::create($request->all());

    //      return redirect('/bookingwithdriver');

    // }


    // public function store_booking_withdriver(Request $request){



    //         $validatedData = $request->validate([
    //             'user_id' => 'required|exists:users,id',
    //             'admincars_id' => 'required|exists:admincars,id',
    //             'carprice' => 'required|numeric',
    //             'pickuptime' => 'required',
    //             'pickupdate' => 'required|date',
    //             'dropofftime' => 'required',
    //             'dropoffdate' => 'required|date',
    //             'destination' => 'required|string|max:255',
    //             'daytrip' => 'required|integer',
    //             'status' => 'required|string',
    //             'totalPrice' => 'required|numeric'
    //         ]);

    //         $booking = new Booking($validatedData);
    //         $booking->total_price = $validatedData['totalPrice'];

    //         $user = User::findOrFail($validatedData['user_id']);
    //         $car = AdminCar::findOrFail($validatedData['admincars_id']);
    //         $booking->user()->associate($user);
    //         $booking->adminCar()->associate($car);

    //         $booking->save();

    //         return redirect()->back()->with('success', 'Booking added successfully');
    //     }
    public function store_booking_withdriver(Request $request){


        $request->validate([
            'user_id' => 'required',
            'carname' => 'required', // Ensure this is the car's ID
            'pickupdate' => 'required|date',
            'pickuptime' => 'required',
            'dropoffdate' => 'required|date',
            'dropofftime' => 'required',
            'destination' => 'required|string',
            'daytrip' => 'required|integer',
        ]);

        // Fetch the selected car details from the database
        $carDetail = Admincar::findOrFail($request->input('carname')); // This should be the ID of the car
        $data = new Booking();
        $data->user_id = $request->input('user_id');

        $data->admincars_id = $carDetail->id;
        $data->carname = $carDetail->carname;
        $data->carprice = $carDetail->carprice;
        $data->carmodel = $carDetail->carmodel;  // Include car model
        $data->carseats = $carDetail->carseats;  // Include car seats
        $data->pickupdate = $request->input('pickupdate');
        $data->pickuptime = $request->input('pickuptime');
        $data->dropoffdate = $request->input('dropoffdate');
        $data->dropofftime = $request->input('dropofftime');
        $data->destination = $request->input('destination');
        $data->daytrip = $request->input('daytrip');
        $data->status = $request->input('status');

        // Calculate total payment
        $totalPayment = $request->input('daytrip') * $carDetail->carprice;
        $data->total_payment = $totalPayment;

        $data->save(); // Save the booking

        // Log the activity
        $activityLog = [
            'name'        => auth()->user()->name,
            'email'       => auth()->user()->email,
            'description' => 'Created Withdriver Book',
            'date_time'   => now()->toDayDateTimeString(),
        ];

        DB::table('activity_logs')->insert($activityLog);

        return redirect()->back()->with('message', 'You have successfully submitted your booking');
        }



}



