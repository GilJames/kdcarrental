<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function adminReports()
    {
        return view('admin.admin_reports');
    }
}
