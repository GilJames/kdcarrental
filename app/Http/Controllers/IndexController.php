<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admincar;

class IndexController extends Controller
{
    //

        public function indexcar(){

            $data = Admincar::get();
            return view('index' , compact('data'));
        }
}
