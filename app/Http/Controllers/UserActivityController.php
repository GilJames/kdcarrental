<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserActivityController extends Controller
{
    public function userActivity()
    {
        $activityLog = DB::table('activity_logs')->get();
        return view('admin.activity_log',compact('activityLog'));
    }

    public function adminActivity()
    {
        $activityLog = DB::table('admin_activity_logs')->get();
        return view('admin.admin-activity-log',compact('activityLog'));
    }
}
