<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPegawaiController extends Controller
{

    public function index(){
        return view('pages.dashboard.dashboardpegawai');
    }
    //
}
