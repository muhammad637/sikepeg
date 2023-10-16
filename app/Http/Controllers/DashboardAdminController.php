<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    //
    // $reminderSTR = STR::whereDate('');
    public function index(){
        // $str = STR::where('');
        return view('pages.dashboard.index');
    }
}
