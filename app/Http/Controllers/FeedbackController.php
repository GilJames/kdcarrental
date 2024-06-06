<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\Booking;
use App\Models\Admincar;
use App\Models\Selfdrive;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class FeedbackController extends Controller
{
    public function storecomment(Request $request)
    {

        $request->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);

        $book_id = $request->book_id;
        // add condition
        $model =  $request->input('model');

        if($model === 'withdrive'){

            Booking::find($request->input('book_id'))->update([
                'lastrate' =>  Carbon::now()->toDateString(),
            ]);


        }elseif($model === 'selfdrive'){

            Selfdrive::find($request->input('book_id'))->update([
                'lastrate' =>  Carbon::now()->toDateString(),
            ]);
        }
        $data = new Feedback();
        $data->book_id = $book_id;
        $data->user_id = Auth::user()->id;
        $data->admincars_id = $request->input('admincars_id');
        $data->comment = $request->input('comment');
        $data->rating = $request->input('rating');
        $data->booking_model = $model == 'selfdrive'? 'selfdrive' : 'withdrive';

        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'Posted Reviews',
            'date_time'   => $todayDate,
        ];


        $data->save();
        DB::table('activity_logs')->insert($activityLog);
        //  end condition
        return redirect()->back()->with('message', 'Your rating has successfully posted');
    }

    public function feedback()
    {
        $feedback = Feedback::paginate(10);

        return view('admin.admin_feedback' , compact('feedback'));
    }

    public function deletefeedback($id)
    {
        $data = Feedback::where('id', '=', $id)->first();


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
            'description' => 'Admin deleted feedback',
            'date_time'   => $todayDate,
        ];

        $data->delete();
        DB::table('admin_activity_logs')->insert($activityLog);
        return redirect()->back()->with('info', 'Reviews Deleted Successfully');
    }

    public function deleteComment($id)
    {
        if (Auth::check()) {
            $comment = Feedback::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->first();

            if ($comment) {
                $comment->delete();
            }
        }

        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();

        $activityLog = [

            'name'        => $name,
            'email'       => $email,
            'description' => 'Deleted Reviews',
            'date_time'   => $todayDate,
        ];

        DB::table('activity_logs')->insert($activityLog);
        return redirect()->route('viewcardetails', ['id' => $id]);
    }


    public function getDataRate(Request $request) {

        $book = $request->model === 'withdrive'? Feedback::where('book_id', $request->id)->where('booking_model', 'withdrive')->first() : Feedback::where('book_id', $request->id)->where('booking_model', 'selfdrive')->first();

        return response()->json([
            'book' => $book,
        ]);
    }

    public function searchFeedback(Request $request){

        $search = $request->input('search');

        $feedback = Feedback::query()
            ->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('admincar', function ($admincarQuery) use ($search) {
                $admincarQuery->where('carname', 'LIKE', "%{$search}%")
                    ->orWhere('comment', 'LIKE', "%{$search}%")
                    ->orWhere('rating', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.admin_feedback', compact('feedback'));


    }
}
